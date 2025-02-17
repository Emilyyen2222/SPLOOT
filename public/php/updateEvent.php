<?php
header('Content-Type: application/json');
include './PdoConnection.php';

$postData = json_decode(file_get_contents("php://input"), true);

$event_id = $postData['eventId'];
$title = $postData['title'];
$event_start_date = $postData['eventStartDate'];
$time_start = $postData['timeStart'];
$event_end_date = $postData['eventEndDate'];
$time_end = $postData['timeEnd'];
$location = $postData['location'];
$description = $postData['description'];
$capacity = $postData['capacity'];
$full_capacity = $postData['fullCapacity'];
$contact = $postData['contact'];
$updater = $postData['updater'];
$response = [];

$sql_update = "
  UPDATE EVENT
  SET
    title = :title,
    event_start_date = :event_start_date,
    time_start = :time_start,
    event_end_date = :event_end_date,
    time_end = :time_end,
    location = :location,
    description = :description,
    capacity = :capacity,
    full_capacity = :full_capacity,
    contact = :contact,
    updater = :updater,
    last_updated_date = CURRENT_TIMESTAMP
  WHERE
    event_id = :event_id
";

$stmt_update = $pdo->prepare($sql_update);
$stmt_update->bindValue(':event_id', $event_id, PDO::PARAM_INT);
$stmt_update->bindValue(':title', $title, PDO::PARAM_STR);
$stmt_update->bindValue(':event_start_date', $event_start_date, PDO::PARAM_STR);
$stmt_update->bindValue(':time_start', $time_start, PDO::PARAM_STR);
$stmt_update->bindValue(':event_end_date', $event_end_date, PDO::PARAM_STR);
$stmt_update->bindValue(':time_end', $time_end, PDO::PARAM_STR);
$stmt_update->bindValue(':location', $location, PDO::PARAM_STR);
$stmt_update->bindValue(':description', $description, PDO::PARAM_STR);
$stmt_update->bindValue(':capacity', $capacity, PDO::PARAM_INT);
$stmt_update->bindValue(':full_capacity', $full_capacity, PDO::PARAM_INT);
$stmt_update->bindValue(':contact', $contact, PDO::PARAM_STR);
$stmt_update->bindValue(':updater', $updater, PDO::PARAM_STR);
$stmt_update->execute();

if($stmt_update->rowCount() > 0){
  $response = [
    'status' => 'success'
  ];
}else{
  $response = [
    'status' => 'error',
    'message' => 'Event not Updated'
  ];
}


echo json_encode($response);
?>