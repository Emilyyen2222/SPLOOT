<?php
header('Content-Type: application/json');
session_start();

$response = [];

if (isset($_SESSION['userId'])) {
    $response = [
      'status' => 'loggedIn',
      'message' => '已經登入',
      'userId' => $_SESSION['userId']
    ];
} else {
    $response = [
        'status' => 'loggedOut',
        'message' => '未登入'
    ];
}

echo json_encode($response);
?>
