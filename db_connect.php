<?php
// database connection details
$servername = "localhost";
$username = "user";
$password = "password";
$dbname = "db_name";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>