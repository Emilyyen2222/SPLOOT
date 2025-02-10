<?php
header('Content-Type: application/json');
session_start();
session_destroy();

$response = [];

if (isset($_SESSION['userId'])) {
    $response = [
      'status' => 'error',
      'message' => '未登出'
    ];
} else {
    $response = [
        'status' => 'success',
      'message' => '已登出'
    ];
}

echo json_encode($response);
?>
