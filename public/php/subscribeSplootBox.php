<?php
header('Content-Type: application/json; charset=UTF-8');

include './PdoConnection.php';
include './GenRandom.php';
session_start();

$postData = json_decode(file_get_contents("php://input"), true);

// birth_date can be Null
$user_id = $_SESSION['userId'] ? $_SESSION['userId'] : '1' ;
$pet_name = $postData['petName'];
$pet = $postData['pet'];
$gender = $postData['gender'];
$size = $postData['size'];
$breed = $postData['breed'];
$birth_date = $postData['birthDate']; // Null
$plan = $postData['plan'];
$period = $postData['period'];
$deliver_city = $postData['deliverCity'];
$deliver_district = $postData['deliverDistrict'];
$deliver_street = $postData['deliverStreet'];
$number = $postData['number'];
$expire_month = $postData['expireMonth'];
$expire_year = $postData['expireYear'];
$holder_name = $postData['holderName'];
$cvc = $postData['cvc'];
$hashedNumber = password_hash($number, PASSWORD_BCRYPT);
$hashedExpireMonth = password_hash($expire_month, PASSWORD_BCRYPT);
$hashedExpireYear = password_hash($expire_year, PASSWORD_BCRYPT);
$hashedHolderName = password_hash($holder_name, PASSWORD_BCRYPT);
$hashedCvc = password_hash($cvc, PASSWORD_BCRYPT);
$response = [];

if(isset($user_id)){
  $sql_insert_sub = "
  INSERT INTO SPLOOTBOX_SUB (
    user_id,
    box_id,
    remain_deliver_count,
    deliver_city,
    deliver_district,
    deliver_street
  ) 
  VALUES (
    :user_id,
    (
        SELECT box_id from SPLOOTBOX
        WHERE plan = :plan
        AND period = :period
        AND box_status = 1
        LIMIT 1
    ),
    :period,
    :deliver_city,
    :deliver_district,
    :deliver_street
  )";
  
  $stmt_insert_sub = $pdo->prepare($sql_insert_sub);
  
  $stmt_insert_sub->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt_insert_sub->bindValue(':plan', $plan, PDO::PARAM_STR);
  $stmt_insert_sub->bindValue(':period', $period, PDO::PARAM_STR);
  $stmt_insert_sub->bindValue(':deliver_city', $deliver_city, PDO::PARAM_STR);
  $stmt_insert_sub->bindValue(':deliver_district', $deliver_district, PDO::PARAM_STR);
  $stmt_insert_sub->bindValue(':deliver_street', $deliver_street, PDO::PARAM_STR);
  
  $stmt_insert_sub->execute();

  $sub_id = $pdo->lastInsertId();

  $sql_insert_subCard = "
  INSERT INTO SPLOOTBOX_CARD (
    sub_id,
    pet_name,
    pet,
    gender,
    size,
    breed,
    birth_date
    
  ) 
  VALUES (
    :sub_id,
    :pet_name,
    :pet,
    :gender,
    :size,
    :breed,
    :birth_date
  )";
  
  $stmt_insert_subCard = $pdo->prepare($sql_insert_subCard);
  
  $stmt_insert_subCard->bindValue(':sub_id', $sub_id, PDO::PARAM_INT);
  $stmt_insert_subCard->bindValue(':pet_name', $pet_name, PDO::PARAM_STR);
  $stmt_insert_subCard->bindValue(':pet', $pet, PDO::PARAM_STR);
  $stmt_insert_subCard->bindValue(':gender', $gender, PDO::PARAM_STR);
  $stmt_insert_subCard->bindValue(':size', $size, PDO::PARAM_STR);
  $stmt_insert_subCard->bindValue(':breed', $breed, PDO::PARAM_STR);
  $stmt_insert_subCard->bindValue(':birth_date', $birth_date, PDO::PARAM_STR);
  
  $stmt_insert_subCard->execute();

  $sql_insert_payment = "
  INSERT INTO SPLOOTBOX_PAYMENT (
      sub_id,
      number,
      expire_month,
      expire_year,
      holder_name,
      cvc
  ) 
  VALUES (
      :sub_id,
      :number,
      :expire_month,
      :expire_year,
      :holder_name,
      :cvc
  )";
  
  $stmt_insert_payment = $pdo->prepare($sql_insert_payment);
  
  $stmt_insert_payment->bindValue(':sub_id', $sub_id, PDO::PARAM_STR);
  $stmt_insert_payment->bindValue(':number', $hashedNumber, PDO::PARAM_STR);
  $stmt_insert_payment->bindValue(':expire_month', $hashedExpireMonth, PDO::PARAM_STR);
  $stmt_insert_payment->bindValue(':expire_year', $hashedExpireYear, PDO::PARAM_STR);
  $stmt_insert_payment->bindValue(':holder_name', $hashedHolderName, PDO::PARAM_STR);
  $stmt_insert_payment->bindValue(':cvc', $hashedCvc, PDO::PARAM_STR);
  
  $stmt_insert_payment->execute();

  $response = [
    'status' => 'success'
  ];
}else{
  $response = [
    'status' => 'error',
    'message' => '未登入'
  ];
}
 
echo $response['status'];
echo json_encode($response);
?>