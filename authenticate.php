<?php
session_start();
require_once "db.php";

$username = $_POST['username'];
$password = md5($_POST['password']); // Use password_hash in production

$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    if ($user['role'] === 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: user.php");
    }
} else {
    echo "Invalid credentials.";
}
?>
