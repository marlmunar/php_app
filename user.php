<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
echo "<h1>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</h1>";
echo "<a href='logout.php'>Logout</a>";
?>