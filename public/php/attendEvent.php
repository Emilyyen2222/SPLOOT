<?php
header('Content-Type: application/json');
include './PdoConnection.php';
session_start();

$postData = json_decode(file_get_contents("php://input"), true);

$user_id = $_SESSION['userId'];
$event_id = $postData['eventId'];
$attendStatus = $postData['attendStatus'];

$response = [];

$sql_select = "
  SELECT 
    attend_status 
  FROM EVENT_ATTEND
  WHERE user_id = :user_id
  AND event_id = :event_id
";

$stmt_select = $pdo->prepare($sql_select);
$stmt_select->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt_select->bindValue(':event_id', $event_id, PDO::PARAM_INT);
$stmt_select->execute();

$eventAttend = $stmt_select->fetch(PDO::FETCH_ASSOC);

if($eventAttend){
  $sql_update = "
    UPDATE EVENT_ATTEND
    SET 
      attend_status = :attend_status,
      last_updated_date = CURRENT_TIMESTAMP
    WHERE user_id = :user_id
    AND event_id = :event_id
  ";

  $stmt_update = $pdo->prepare($sql_update);
  $stmt_update->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt_update->bindValue(':event_id', $event_id, PDO::PARAM_INT);
  $stmt_update->bindValue(':attend_status', $attendStatus, PDO::PARAM_INT);
  $stmt_update->execute();

  $response = [
    'status' => 'success',
    'message' => 'eventAttend Updated'
  ];
}else if(isset($user_id) && isset($event_id)){
  $sql_insert = "
    INSERT INTO EVENT_ATTEND (
        user_id,
        event_id,
        attend_status
    ) 
    VALUES (
        :user_id,
        :event_id,
        :attend_status
    )";

  $stmt_insert = $pdo->prepare($sql_insert);

  $stmt_insert->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt_insert->bindValue(':event_id', $event_id, PDO::PARAM_INT);
  $stmt_insert->bindValue(':attend_status', $attendStatus, PDO::PARAM_INT);

  $stmt_insert->execute();


  $response = [
    'status' => 'success',
    'message' => 'eventAttend Inserted'
  ];
}else{
  $response = [
    'status' => 'error',
    'message' => '使用者未登入 / 找不到活動'
  ];
}


echo json_encode($response);
?>