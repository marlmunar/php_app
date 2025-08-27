<?php
require '../../db.php';
require 'get_data.php';
require 'json_response.php';

$data = getData();
$title = $data['title'] ?? '';
$detail  = $data['detail'] ?? '';

if (!$title || !$detail) {
    $response = ['message' => 'Title and detail are required'];
    sendJsonResponse($response, 400);
}

$stmt = $conn->prepare("INSERT INTO tasks (title, detail) VALUES (:title, :detail)");
$stmt->bindParam(':title', $title);
$stmt->bindParam(':detail', $detail);

if ($stmt->execute()) {
    $response = ['message' => 'Task created'];
    sendJsonResponse($response, 201);
} else {
    $response = ['message' => 'Failed to create task'];
    sendJsonResponse($response, 500);
}

?>