<?php
require '../../db.php';
require 'get_data.php';
require 'json_response.php';

$data = getData();
$id = $data['id'] ?? null;

if ($id === null || !is_numeric($id)) {
    sendJsonResponse(['message' => 'ID is required and must be numeric'], 400);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id");
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    $task = $stmt->fetch();
    if ($task) {
        $response = ['message' => 'Task found', 'data' => $task];
        $statusCode = 200;
    } else {
        $response = ['message' => 'Not found'];
        $statusCode = 404;
    }
    sendJsonResponse($response, $statusCode);
} else {
    $response = ['message' => 'Failed to fetch task'];
    sendJsonResponse($response, 500);
}