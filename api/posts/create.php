<?php
require '../../db.php';

$data = json_decode(file_get_contents("php://input"), true);
$title = $data['title'] ?? '';
$body  = $data['body'] ?? '';

$stmt = $conn->prepare("INSERT INTO posts (title, body) VALUES (:title, :body)");
$stmt->bindParam(':title', $title);
$stmt->bindParam(':body', $body);

header('Content-Type: application/json');

if ($stmt->execute()) {
    echo json_encode(['message' => 'Post created']);
} else {
    echo json_encode(['message' => 'Failed']);
}

?>