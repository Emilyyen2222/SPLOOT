<?php
include 'PdoConnection.php';

header("Content-Type:application/json");
session_start();

// 解包JSON
$postData = json_decode(file_get_contents("php://input"), true);
$response = [];


// 查詢
$user_id = $_SESSION['userId'];
$sql_select = "
  select
    email,
    password,
    first_name as firstName,
    last_name as lastName,
    nickname,
    gender,
    birth_date as birthDate,
    line_id as lineId,
    phone,
    address_city as addressCity,
    address_district as addressDistrict,
    address_street as addressStreet,
    portrait
  from USER
  WHERE user_id = :user_id
";


$stmt_select = $pdo->prepare($sql_select);
$stmt_select->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt_select->execute();
$user = $stmt_select->fetch(PDO::FETCH_ASSOC);

if ($user){
  $response = [
    'status' => 'success',
    'email' => $user['email'],
    'password' => $user['password'],
    'firstName' => $user['firstName'],
    'lastName' => $user['lastName'],
    'nickname' => $user['nickname'],
    'gender' => $user['gender'],
    'birthDate' => $user['birthDate'],
    'lineId' => $user['lineId'],
    'phone' => $user['phone'],
    'addressCity' => $user['addressCity'],
    'addressDistrict' => $user['addressDistrict'],
    'addressStreet' => $user['addressStreet'],
    'portrait' => $user['portrait']
  ];
}else{
  $response = [
    'status' => 'error',
    'message' => '無使用者'
  ];
}


echo json_encode($response);
?>