<?php
$host_name = "localhost:3306";
$database = "patientenverwaltung"; // Change your database name
$username = "root"; // Your database user id
$password = "root"; // Your password

try {
    $config = new PDO('mysql:host=' . $host_name . ';dbname=' . $database, $username, $password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}