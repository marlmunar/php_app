<?php
// mysqli::__construct(
//     string $host = "localhost",
//     string $username = "root",
//     string $password = "",
//     string $database = "",
//     int $port = 3306,
//     string $socket = ""
// )

$conn = new mysqli('localhost', 'root', '', 'php_site');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$name = $_POST['username'] ?? 'Guest';
$conn->query("INSERT INTO users (username) VALUES ('$name')");
echo "<h1>Welcome, $name!</h1>";
?>