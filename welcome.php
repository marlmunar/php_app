<?php
// connecting to DB with mysqli
// mysqli::__construct(
//     string $host = "localhost",
//     string $username = "root",
//     string $password = "",
//     string $database = "",
//     int $port = 3306,
//     string $socket = ""
// )

// $conn = new mysqli('localhost', 'root', '', 'php_site');

// if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// connecting to DB with PDO

$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$charset = 'utf8mb4';  

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
    echo "Connected successfully!";

    $name = $_POST['username'] ?? 'Guest';
    $conn->query("INSERT INTO users (username) VALUES ('$name')");
    echo "<h1>Welcome, $name!</h1>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>