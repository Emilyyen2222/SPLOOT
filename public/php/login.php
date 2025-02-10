<?php
header('Content-Type: application/json');
include './PdoConnection.php';

$postData = json_decode(file_get_contents("php://input"), true);
$response = [];

$email = $postData["email"];
$password = $postData["password"];

$sql = "
  SELECT
    user_id as userId, 
    password
  FROM USER
  WHERE email = :email
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    if (password_verify($password, $user['password'])) {
        $response = [
            'status' => 'success',
            'userId' => $user['userId'],
        ];
        session_start();
        $_SESSION['userId'] = $user['userId'];

    } else {
        $response = [
            'status' => 'error',
            'message' => '密碼錯誤'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => '無此使用者'
    ];
}

echo json_encode($response);
?>
