<?php
header('Content-Type: application/json; charset=UTF-8');

include './PdoConnection.php';
include './GenRandom.php';

$postData = json_decode(file_get_contents("php://input"), true);

$email = $postData["email"];
$password = $postData["password"];
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$response = [];

$sql_check_email = "SELECT COUNT(*) FROM USER WHERE email = :email";
$stmt_check_email = $pdo->prepare($sql_check_email);
$stmt_check_email->bindValue(':email', $email, PDO::PARAM_STR);
$stmt_check_email->execute();
$email_exists = $stmt_check_email->fetchColumn();

if($email_exists > 0) {
    $response = [
        'status' => 'error',
        'message' => '信箱已註冊'
    ];
}else{
    // $random_exists = 1;

    // while($random_exists > 0){
    //     $random_id = generateRandom();

    //     $sql_check_random = "SELECT random_id FROM USER WHERE random_id = :random_id";
    //     $stmt_check_random = $pdo->prepare($sql_check_random);
    //     $stmt_check_random->bindValue(':random_id', $random_id, PDO::PARAM_STR);
    //     $stmt_check_random->execute();
    //     $random_exists = $stmt_check_random->fetchColumn();
    // };

    $sql_insert = "
    INSERT INTO USER (
        email, 
        password
    ) 
    VALUES (
        :email, 
        :password
    )";

    $stmt_insert = $pdo->prepare($sql_insert);

    $stmt_insert->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt_insert->bindValue(':password', $hashedPassword, PDO::PARAM_STR);

    $stmt_insert->execute();

    $response = [
        'status' => 'success',
    ];
}

echo json_encode($response);
?>
