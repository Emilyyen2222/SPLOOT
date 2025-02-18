<?php
header('Content-Type: application/json');
include './PdoConnection.php';
session_start();

$postData = json_decode(file_get_contents("php://input"), true);

$user_id = $_SESSION['userId'];
$service = $postData['service'];
$title = $postData['title'];
$service_city = $postData['serviceCity'];
$service_district = $postData['serviceDistrict'];
$service_time_start = $postData['serviceTimeStart'];
$service_time_end = $postData['serviceTimeEnd'];
$description = $postData['description'];
$post_img = $postData['postImg'];
$response = [];

$sql_insert = "
  INSERT INTO HELPER_POST
  (
    helper_id,
    service,
    title,
    service_city,
    service_district,
    service_time_start,
    service_time_end,
    description,
    post_img
  )
  VALUES(
    :user_id,
    :service,
    :title,
    :service_city,
    :service_district,
    :service_time_start,
    :service_time_end,
    :description,
    :post_img
  )";

$stmt_insert = $pdo->prepare($sql_insert);
$stmt_insert->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt_insert->bindValue(':service', $service, PDO::PARAM_STR);
$stmt_insert->bindValue(':title', $title, PDO::PARAM_STR);
$stmt_insert->bindValue(':service_city', $service_city, PDO::PARAM_STR);
$stmt_insert->bindValue(':service_district', $service_district, PDO::PARAM_STR);
$stmt_insert->bindValue(':service_time_start', $service_time_start, PDO::PARAM_STR);
$stmt_insert->bindValue(':service_time_end', $service_time_end, PDO::PARAM_STR);
$stmt_insert->bindValue(':description', $description, PDO::PARAM_STR);
$stmt_insert->bindValue(':post_img', base64_decode($post_img), PDO::PARAM_LOB);
$stmt_insert->execute();

if($stmt_insert->rowCount() > 0){
  $response = [
    'status' => 'success'
  ];
}else{
  $response = [
    'status' => 'error',
    'message' => 'Buddy Post not Inserted'
  ];
}

echo json_encode($response);

?>