<?php
$host = 'localhost';
$db   = 'threadline_dbms'; // your database name
$user = 'root';          // your phpMyAdmin username
$pass = '';              // your phpMyAdmin password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>