<?php
header('Content-Type: application/json');
include './PdoConnection.php';
session_start();

$user_id = $_SESSION['userId'];
$response = [];

if (isset($user_id)) {
    $sql_select = "SELECT portrait FROM USER WHERE user_id = :user_id";

    $stmt_select = $pdo->prepare($sql_select);
    $stmt_select->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt_select->execute();

    $user = $stmt_select->fetch(PDO::FETCH_ASSOC);

    $response = [
      'status' => 'success',
      'portrait' => $user['portrait']
    ];
} else {
    $response = [
      'status' => 'error',
      'message' => '無使用者'
    ];
}

echo json_encode($response);
?>
