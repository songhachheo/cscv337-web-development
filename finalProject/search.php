<?php

$host = "192.168.0.5";
$port = "3306";
$user = "root";
$pass = "Be@rD0wN!";
$db = "test";

//open connection to mysql db
$connection = mysqli_connect("$host", "$user", "$pass", "$db") or die("Error " . mysqli_error($connection));

//fetch table rows from mysql db
$sql = "SELECT * FROM cache_data";
$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

//create an array
$getJson = array();
while ($row = mysqli_fetch_assoc($result)) {
    $getJson[] = $row;
}
echo json_encode($getJson);

//close the db connection
mysqli_close($connection);
