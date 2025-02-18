<?php
header('Content-Type: application/json');
include './PdoConnection.php';

$postData = json_decode(file_get_contents("php://input"), true);
$pet_id = $postData['petId'];
$updater = $postData['updater'];
$response = [];

$sql_delete = "
  UPDATE PET
  SET 
    pet_status = 0,
    updater = :updater,
    last_updated_date = CURRENT_TIMESTAMP
  WHERE
    pet_id = :pet_id
";

$stmt_delete = $pdo->prepare($sql_delete);
$stmt_delete->bindValue(':pet_id', $pet_id, PDO::PARAM_INT);
$stmt_delete->bindValue(':updater', $updater, PDO::PARAM_STR);
$stmt_delete->execute();

if($stmt_delete->rowCount() > 0){
  $response = [
    'status' => 'success'
  ];
}else{
  $response = [
    'status' => 'error',
    'message' => 'PetCard not Deleted'
  ];
}

echo json_encode($response);
?>