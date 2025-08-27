<?php
require '../../db.php';
require 'json_response.php';

$stmt = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC");

if ($stmt) {
    $tasks = $stmt->fetchAll();
    $response = ['message' => 'Successfully fetched tasks', 'data' => $tasks];
    sendJsonResponse($response, 200);
} else {
    $response = ['message' => 'Failed to get tasks'];
    sendJsonResponse($response, 500);
}

?>