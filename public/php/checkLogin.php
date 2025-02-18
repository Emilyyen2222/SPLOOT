<?php
header('Content-Type: application/json');
session_start();

$user_id = $_SESSION['userId'];
$response = [];

if (isset($user_id)) {
    $response = [
      'status' => 'loggedIn',
      'message' => '已經登入'
    ];
} else {
    $response = [
        'status' => 'loggedOut',
        'message' => '未登入'
    ];
}

echo json_encode($response);
?>
