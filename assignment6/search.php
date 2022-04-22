<?php
# CSE 190M Homework 8 (Kevin Bacon) actor ID lookup service
# This is provided to the students and doesn't need to be modified by them.

# "constants"

include("common.php");

$SERVER   = "mysql-server";
$USER     = "root";
$PASSWORD = "Be@rD0wn!";
$DATABASE = "imdb";
$MIN_TOTAL_LENGTH = 2;
$MAX_DELAY = 30;
$MAX_ACTORS = 50;

$first_name = clean("first_name", "");
$last_name  = clean("last_name",  "");
if (strlen($first_name) + strlen($last_name) < $MIN_TOTAL_LENGTH) {
    header("HTTP/1.1 400 Invalid Request");
    die("ERROR 400 - Invalid request.  This service requires parameters named either 'first_name' or 'last_name' of total length >= $MIN_TOTAL_LENGTH");
}

$host = "mysql-server";
$user = "root";
$pass = "Be@rD0wN!";
$db = "imdb";
try {
    $db = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

//grab user input
$first_name = isset($_GET['first_name']) ? clean($_GET['first_name']) : '';
$last_name = isset($_GET['last_name']) ? clean($_GET['last_name']) : '';

//removes special charachters from strings
function clean($string)
{
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}

//queries movies given actor is in with Kevin Bacon
function withKevin($first_name, $last_name, $db)
{
    $first_name = clean($first_name);
    $last_name = clean($last_name);
    $sql = "SELECT movies.name, year from movies inner join (roles INNER JOIN actors ON actors.id = roles.actor_id) ON movies.id = roles.movie_id "
        . "Where movies.id in "
        . "(SELECT movies.id from movies inner join (roles INNER JOIN actors ON actors.id = roles.actor_id) ON movies.id = roles.movie_id "
        . "WHERE actors.first_name = 'Kevin' and actors.last_name = 'Bacon') "
        . "AND roles.actor_id = "
        . "(SELECT min(ID) FROM actors WHERE "
        . "actors.first_name LIKE '" . $first_name . "%' AND actors.last_name LIKE '" . $last_name . "%')";
    return $db->query($sql);
}

//fetch query data
$matches = withKevin($first_name, $last_name, $db);
$matchesInfo = $matches->fetchAll();

top();
//display results based on correct input
if (empty($first_name) || empty($last_name)) {
    echo ("<p> Enter an Actor's First and Last Name</p>");
} else if (!empty($matchesInfo)) {
    echo ("<h2>" . $first_name . " " . $last_name . " and Kevin Bacon were together in: </h2>");
    echo ("<table>");
    echo ("<tr><th>No.</th><th>Title</th><th>Year</th></tr>");
    $i = 1;
    foreach ($matchesInfo as $row) {
        echo ("<tr>");
        echo ("<td>$i</td><td>" . $row['name'] . "</td><td>" . $row['year'] . "</td></tr>");
        $i++;
    }
    echo ("</table>");
} else if (!empty($first_name) && !empty($last_name)) {
    echo ("<p>" . $first_name . " " . $last_name . " was not in any films with Kevin Bacon.</p>");
}

function allMovies($first_name, $last_name, $db)
{
    $first_name = clean($first_name);
    $last_name = clean($last_name);
    $sql = "SELECT movies.name, movies.year "
        . "FROM movies "
        . "INNER JOIN roles ON movies.id = roles.movie_id "
        . "JOIN actors ON actors.id = roles.actor_id "
        . "WHERE actors.first_name LIKE '" . $first_name . "%' AND actors.last_name LIKE '" . $last_name . "%'"
        . "ORDER BY movies.year DESC, movies.name";
    return $db->query($sql);
}
//fetch query data
$matches = allMovies($first_name, $last_name, $db);
$matchesInfo = $matches->fetchAll();

//display results based on correct input
if (!empty($matchesInfo)) {
    echo ("<h2> All of " . $first_name . " " . $last_name . " performances: </h2>");
    echo ("<table>");
    echo ("<tr><th>No.</th><th>Title</th><th>Year</th></tr>");
    $i = 1;
    foreach ($matchesInfo as $row) {
        echo ("<tr>");
        echo ("<td>$i</td><td>" . $row['name'] . "</td><td>" . $row['year'] . "</td></tr>");
        $i++;
    }
    echo ("</table>");
} else if (!empty($first_name) && !empty($last_name)) {
    echo ("<p>" . $first_name . " " . $last_name . " was in no other movies. </p>");
}

bottom();
