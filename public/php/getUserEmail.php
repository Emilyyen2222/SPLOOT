<?php
header('Content-Type: application/json');
include './PdoConnection.php';
session_start();

$response = [];

if (isset($_SESSION['userId'])) {
    $sql_select = "SELECT email FROM USER WHERE user_id = :user_id";

    $stmt_select = $pdo->prepare($sql_select);
    $stmt_select->bindValue(':user_id', $_SESSION['userId'], PDO::PARAM_STR);
    $stmt_select->execute();

    $user = $stmt_select->fetch(PDO::FETCH_ASSOC);

    $response = [
      'status' => 'success',
      'email' => $user['email']
    ];
} else {
    $response = [
      'status' => 'error',
      'message' => '無使用者'
    ];
}

echo json_encode($response);
?>
