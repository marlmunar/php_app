<?php
session_start();
require_once "db.php";

$username = $_POST['username'];
$password = md5($_POST['password']); 

$stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");

$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

$stmt->execute();

$user = $stmt->fetch();

if ($user) {
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
