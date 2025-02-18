<?php
header('Content-Type: application/json');
include './PdoConnection.php';
session_start();

$user_id = $_SESSION['userId'];
$response = ['response'];

$sql_select = "
  SELECT
    pet_id as petId,
    pet,
    name,
    gender,
    breed,
    birth_date as birthDate,
    size,
    neutured,
    description
  FROM PET
  WHERE pet_status = 1
  AND user_id = :user_id;
";

$stmt_select = $pdo->prepare($sql_select);
$stmt_select->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt_select->execute();
$pets = $stmt_select->fetchAll();

if ($pets) {
  $response = [
    'status' => 'success',
    'data' => []
  ];

  foreach($pets as $pet){
    $pet['petHobby'] = [];
    $pet['petSocial'] = [];

    $sql_select_petHobby = "
    SELECT
      hobby
    FROM PET_HOBBY
    WHERE pet_id = :pet_id
    AND active_status = 1
    ";

    $stmt_select_petHobby = $pdo->prepare($sql_select_petHobby);
    $stmt_select_petHobby->bindValue(':pet_id', $pet['petId'], PDO::PARAM_INT);
    $stmt_select_petHobby->execute();
    $hobbies = $stmt_select_petHobby->fetchAll();

    foreach($hobbies as $hobby){
      $pet['petHobby'][] = $hobby['hobby']; 
    }

    $sql_select_petSocial = "
    SELECT
      sociality
    FROM PET_SOCIAL
    WHERE pet_id = :pet_id
    AND active_status = 1
    ";

    $stmt_select_petSocial = $pdo->prepare($sql_select_petSocial);
    $stmt_select_petSocial->bindValue(':pet_id', $pet['petId'], PDO::PARAM_INT);
    $stmt_select_petSocial->execute();
    $socialities = $stmt_select_petSocial->fetchAll();

    foreach($socialities as $social){
      $pet['petSocial'][] = $social['sociality']; 
    }

    $response['data'][] = $pet;
  }
} else {
  $response = [
      'status' => 'error',
      'message' => '沒有寵物卡'
  ];
}

echo json_encode($response);
?>
