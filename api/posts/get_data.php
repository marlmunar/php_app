<?php 
require 'json_response.php';
function getData() {
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

    if (stripos($contentType, 'application/json') !== false) {
        $raw = file_get_contents("php://input");
        $data = json_decode($raw, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $response =['message' => 'Invalid JSON'];
            sendJsonResponse($response, 400);
        }

        return is_array($data) ? $data : [];
    }

    return array_merge($_GET, $_POST);
}

?>