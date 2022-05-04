<?php
$host = "192.168.0.5";
$port = "3306";
$user = "root";
$pass = "Be@rD0wN!";
$db = "test";

try {
    $db = new PDO("mysql:host=$host:$port;dbname=$db", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
$querytest = "SELECT cache_type FROM cache_types";
$results =  $db->query($querytest);
$rows = $results->fetchAll();

foreach ($rows as $row => $cache_type) {
    echo $cache_type['cache_type'] . "<br>";
}
