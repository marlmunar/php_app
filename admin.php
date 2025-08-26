<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$result = $conn->query("SELECT username, role FROM users WHERE role = 'user'");

echo "<h1>Welcome Admin " . htmlspecialchars($_SESSION['username']) . "</h1>";
echo "<h2>User List:</h2><ul>";

while ($row = $result->fetch_assoc()) {
    echo "<li>" . htmlspecialchars($row['username']) . " - " . htmlspecialchars($row['role']) . "</li>";
}
echo "</ul>";
echo "<a href='logout.php'>Logout</a>";
?>