<?php
$host = "localhost"; // XAMPP/MAMP e default host
$user = "root";      // default MySQL user
$pass = "";          // default password (empty thake)
$db   = "user_system"; // database name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
