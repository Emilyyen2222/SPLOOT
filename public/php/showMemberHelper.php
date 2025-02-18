<?php
include 'PdoConnection.php';

header("Content-Type:application/json");

$postData = json_decode(file_get_contents("php://input"), true);
$response = [];

// $catchData = [];

// 查詢
$user_id = '3';
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
    address_street as addressStreet
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
    'firstName' => $user['firstName'],
    'lastName' => $user['lastName'],
    'nickname' => $user['nickname'],
    'gender' => $user['gender'],
    'birthDate' => $user['birthDate'],
    'lineId' => $user['lineId'],
    'phone' => $user['phone'],
    'addressCity' => $user['addressCity'],
    'addressDistrict' => $user['addressDistrict'],
    'addressStreet' => $user['addressStreet']
  ];
}else{
  $response = [
    'status' => 'error',
    'message' => '無使用者'
  ];
}


// 更新
// $sql_update = "
//   update user
//    set
//     password = password,
//     first_name as firstName = firstName,
//     last_name as lastName = lastName,
//     nickname = nickname,
//     gender = gender,
//     birth_date as birthDate = birthDate,
//     line_id as lineId = lineId,
//     phone = phone,
//     address_city as addressCity = addressCity,
//     address_district as addressDistrict = addressDistrict,
//     address_street as addressStreet = addressStreet
//   from USER
//   WHERE user_id = :user_id
// ";

// $stmt_update = $pdo->prepare($sql_update);
// $stmt_update->bindValue(':user_id', $user_id, PDO::PARAM_INT);
// $stmt_update->execute();
// $user = $stmt_update->fetch(PDO::FETCH_ASSOC);


// if ($user){
//   $catchData = [
//     'status' => 'success',
//     'email' => $user['email'],
//     'firstName' => $user['firstName'],
//     'lastName' => $user['lastName'],
//     'nickname' => $user['nickname'],
//     'gender' => $user['gender'],
//     'birthDate' => $user['birthDate'],
//     'lineId' => $user['lineId'],
//     'phone' => $user['phone'],
//     'addressCity' => $user['addressCity'],
//     'addressDistrict' => $user['addressDistrict'],
//     'addressStreet' => $user['addressStreet']
//   ];
// }else{
//   $catchData = [
//     'status' => 'error',
//     'message' => '無使用者'
//   ];
// }

echo json_encode($response);
?>