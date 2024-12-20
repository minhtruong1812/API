<?php
header('Content-Type: application/json');

// Kiểm tra nếu request là POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    // Kiểm tra JSON hợp lệ
    if (!isset($input['json']) || json_decode($input['json']) === null) {
        echo json_encode(['success' => false, 'error' => 'Dữ liệu JSON không hợp lệ']);
        exit;
    }

    // Tạo ID API
    $api_id = uniqid();
    $file_path = __DIR__ . "/apis/{$api_id}.json";

    // Lưu JSON vào file
    if (!file_exists('apis')) {
        mkdir('apis', 0777, true);
    }

    file_put_contents($file_path, $input['json']);

    // Trả về URL API
    $api_url = "http://{$_SERVER['HTTP_HOST']}/apis/{$api_id}.json";
    echo json_encode(['success' => true, 'api_url' => $api_url]);
} else {
    echo json_encode(['success' => false, 'error' => 'Phương thức yêu cầu không hợp lệ']);
}
