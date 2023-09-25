<?php
date_default_timezone_set('Asia/Beirut');
if(!isset($_SESSION)){
    session_start();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "matjar";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 ?>
