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

$stmt = $conn->prepare("DELETE FROM tasks WHERE public_id = :id");
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
      if ($stmt->rowCount() > 0) {
        sendJsonResponse(['message' => 'Task deleted'], 200);
    } else {
        sendJsonResponse(['message' => 'Task not found'], 404);
    }
} else {
    $response = ['message' => 'Failed to delete task'];
    sendJsonResponse($response, 500);
}

?>