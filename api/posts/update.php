<?php
require '../../db.php';
require 'get_data.php';
require 'json_response.php';

$data = getData();
$id  = $data['id'] ?? null;

if ($id === null || !is_numeric($id)) {
    sendJsonResponse(['message' => 'ID is required and must be numeric'], 400);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM tasks WHERE public_id = :id");
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    $task = $stmt->fetch();
    if (!$task) {
        $response = ['message' => 'Not found'];
        sendJsonResponse($response, 404);
    }
    
} else {
    $response = ['message' => 'Failed to fetch task'];
    sendJsonResponse($response, 500);
}

$title = $data['title'] ?? $task['title'];
$detail  = $data['detail'] ?? $task['detail'];


$stmt = $conn->prepare("UPDATE tasks SET title = :title, detail = :detail WHERE public_id = :id");
$stmt->bindParam(':title', $title);
$stmt->bindParam(':detail', $detail);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    $response = [
        'message' => 'Task updated',  
        'task' => ['title'=>$title, 'detail'=>$detail]
    ];
    sendJsonResponse($response, 200);
} else {
    $response = ['message' => 'Failed to update task'];
    sendJsonResponse($response, 500);
}

?>