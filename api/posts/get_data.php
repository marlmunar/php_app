<?php 
function getData() {
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    if (stripos($contentType, 'application/json') !== false) {
        
           $data = json_decode(file_get_contents("php://input"), true);
            return is_array($data) ? $data : [];
        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid JSON']);
            exit;
        } 
    } 
    
    return $_POST;
}

?>