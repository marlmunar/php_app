<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$stmt = $conn->prepare("SELECT username, role FROM users WHERE role = :role");
$stmt->bindValue(':role', 'user', PDO::PARAM_STR); 
$stmt->execute();

$users = $stmt->fetchAll();

echo "<h1>Welcome Admin " . htmlspecialchars($_SESSION['username']) . "</h1>";
echo "<h2>User List:</h2><ul>";

foreach ($users as $row) {
    echo "<li>" . htmlspecialchars($row['username']) . " - " . htmlspecialchars($row['role']) . "</li>";
}

echo "</ul>";
echo "<a href='logout.php'>Logout</a>";
?>