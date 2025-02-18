<?php
header('Content-Type: application/json');
include './PdoConnection.php';

$postData = json_decode(file_get_contents("php://input"), true);

$pet_id = $postData['petId'];
$pet = $postData['pet'];
$name = $postData['name'];
$gender = $postData['gender'];
$breed = $postData['breed'];
$birth_date = $postData['birthDate'];
$size = $postData['size'];
$neutured = $postData['neutured'];
$description = $postData['description'];
$pet_img = $postData['petImg'];
$pet_hobby = $postData['petHobby'];
$pet_social = $postData['petSocial'];
$updater = $postData['updater'];
$response = [];

$sql_insert = "
UPDATE PET
SET
  pet = :pet,
  name = :name,
  gender = :gender,
  breed = :breed,
  birth_date = :birth_date,
  size = :size,
  neutured = :neutured,
  description = :description,
  pet_img = :pet_img,
  updater = :updater,
  last_updated_date = CURRENT_TIMESTAMP
WHERE
  pet_id = :pet_id
";

$stmt_insert = $pdo->prepare($sql_insert);

$stmt_insert->bindValue(':pet_id', $pet_id, PDO::PARAM_INT);
$stmt_insert->bindValue(':pet', $pet, PDO::PARAM_STR);
$stmt_insert->bindValue(':name', $name, PDO::PARAM_STR);
$stmt_insert->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt_insert->bindValue(':breed', $breed, PDO::PARAM_STR);
$stmt_insert->bindValue(':birth_date', $birth_date, PDO::PARAM_STR);
$stmt_insert->bindValue(':size', $size, PDO::PARAM_STR);
$stmt_insert->bindValue(':neutured', $neutured, PDO::PARAM_STR);
$stmt_insert->bindValue(':description', $description, PDO::PARAM_STR);
$stmt_insert->bindValue(':pet_img', base64_decode($pet_img), PDO::PARAM_LOB);
$stmt_insert->bindValue(':updater', $updater, PDO::PARAM_LOB);
$stmt_insert->execute();


$sql_update_petHobby = "
UPDATE PET_HOBBY
SET active_status = 0
WHERE
    pet_id = :pet_id
AND active_status = 1
";

$stmt_update_petHobby = $pdo->prepare($sql_update_petHobby);
$stmt_update_petHobby->bindValue(':pet_id', $pet_id, PDO::PARAM_INT);

$stmt_update_petHobby->execute();

$sql_insert_petHobby = "
INSERT INTO PET_HOBBY (
    pet_id,
    hobby
) 
VALUES (
    :pet_id,
    :hobby
)";

$stmt_insert_petHobby = $pdo->prepare($sql_insert_petHobby);
$stmt_insert_petHobby->bindValue(':pet_id', $pet_id, PDO::PARAM_INT);

foreach($pet_hobby as $hobby){
  $stmt_insert_petHobby->bindValue(':hobby', $hobby, PDO::PARAM_STR);
  $stmt_insert_petHobby->execute();
};

$sql_update_petSocial = "
UPDATE PET_SOCIAL
SET active_status = 0
WHERE
    pet_id = :pet_id
AND active_status = 1
";

$stmt_update_petSocial = $pdo->prepare($sql_update_petSocial);
$stmt_update_petSocial->bindValue(':pet_id', $pet_id, PDO::PARAM_INT);

$stmt_update_petSocial->execute();

$sql_insert_petSocial = "
INSERT INTO PET_SOCIAL (
    pet_id,
    sociality
) 
VALUES (
    :pet_id,
    :sociality
)";

$stmt_insert_petSocial = $pdo->prepare($sql_insert_petSocial);
$stmt_insert_petSocial->bindValue(':pet_id', $pet_id, PDO::PARAM_INT);

foreach($pet_social as $social){
  $stmt_insert_petSocial->bindValue(':sociality', $social, PDO::PARAM_STR);
  $stmt_insert_petSocial->execute();
};


if($stmt_insert->rowCount() > 0){
  $response = [
    'status' => 'success'
  ];
}else{
  $response = [
    'status' => 'error',
    'message' => '寵物卡建立失敗'
  ];
}

echo json_encode($response);
?>
