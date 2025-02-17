<?php
header('Content-Type: application/json');
include './PdoConnection.php';
session_start();

$postData = json_decode(file_get_contents("php://input"), true);

$user_id = $_SESSION['userId'];
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
$response = [];

$sql_insert = "
  INSERT INTO EVENT
  (
    initiator_id,
    title,
    event_start_date,
    time_start,
    event_end_date,
    time_end,
    location,
    description,
    capacity,
    contact
  )
  VALUES(
    :user_id,
    :title,
    :event_start_date,
    :time_start,
    :event_end_date,
    :time_end,
    :location,
    :description,
    :capacity,
    :contact
  )";

$stmt_insert = $pdo->prepare($sql_insert);
$stmt_insert->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt_insert->bindValue(':title', $title, PDO::PARAM_STR);
$stmt_insert->bindValue(':event_start_date', $event_start_date, PDO::PARAM_STR);
$stmt_insert->bindValue(':time_start', $time_start, PDO::PARAM_STR);
$stmt_insert->bindValue(':event_end_date', $event_end_date, PDO::PARAM_STR);
$stmt_insert->bindValue(':time_end', $time_end, PDO::PARAM_STR);
$stmt_insert->bindValue(':location', $location, PDO::PARAM_STR);
$stmt_insert->bindValue(':description', $description, PDO::PARAM_STR);
$stmt_insert->bindValue(':capacity', $capacity, PDO::PARAM_INT);
$stmt_insert->bindValue(':contact', $contact, PDO::PARAM_STR);
$stmt_insert->execute();

if($stmt_insert->rowCount() > 0){
  $response = [
    'status' => 'success'
  ];
}else{
  $response = [
    'status' => 'error',
    'message' => 'Event not Inserted'
  ];
}

echo json_encode($response);