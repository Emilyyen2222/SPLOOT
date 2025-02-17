<?php
header('Content-Type: application/json');
include './PdoConnection.php';

$postData = json_decode(file_get_contents("php://input"), true);
$event_id = $postData['eventId'];
$updater = $postData['updater'];
$response = [];

$sql_delete = "
  UPDATE EVENT
  SET 
    event_status = 0,
    updater = :updater,
    last_updated_date = CURRENT_TIMESTAMP
  WHERE
    event_id = :event_id
";

$stmt_delete = $pdo->prepare($sql_delete);
$stmt_delete->bindValue(':event_id', $event_id, PDO::PARAM_INT);
$stmt_delete->bindValue(':updater', $updater, PDO::PARAM_STR);
$stmt_delete->execute();

if($stmt_delete->rowCount() > 0){
  $response = [
    'status' => 'success'
  ];
}else{
  $response = [
    'status' => 'error',
    'message' => 'Event not Deleted'
  ];
}

echo json_encode($response);
?>