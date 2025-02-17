<?php
header('Content-Type: application/json');
include './PdoConnection.php';
session_start();

$user_id = $_SESSION['userId'];
$response = [];

$sql_select = "
  select
    e.event_id as eventId,
    e.initiator_id as initiatorId,
    e.title as title,
    e.event_start_date as eventStartDate,
    e.time_start as timeStart,
    e.event_end_date as eventEndDate,
    e.time_end as timeEnd,
    e.location as location,
    e.description as description,
    e.capacity as capacity,
    e.full_capacity as fullCapacity,
    e.contact as contact,
    u.portrait as userPortrait,
    u.first_name as userFirstName,
    u.nickname as userNickname,
    u.line_id as userLineId
  from EVENT e
  left join USER u on e.initiator_id = u.user_id
  WHERE e.event_status = 1
";

$stmt_select = $pdo->prepare($sql_select);
$stmt_select->execute();
$events = $stmt_select->fetchAll();



if($events){
  $response = [ 
    'status' => 'success',
    'data' => []
 ];

  foreach($events as $event){
    $event['eventType'] = $event['initiatorId'] == null ? 'official' : 'splooter';

    if(isset($user_id)){
      // 使用者可編輯
      if($event['initiatorId'] == $user_id){
        $event['attendStatus'] = 'edit';
      }else{
        $sql_select_eventAttend = "
          select attend_status as attendStatus from EVENT_ATTEND
          WHERE user_id = :user_id
          AND event_id = :event_id
        ";
      
        $stmt_select_eventAttend = $pdo->prepare($sql_select_eventAttend);
        $stmt_select_eventAttend->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt_select_eventAttend->bindValue(':event_id', $event['eventId'], PDO::PARAM_INT);
        $stmt_select_eventAttend->execute();

        $eventAttend = $stmt_select_eventAttend->fetch(PDO::FETCH_ASSOC);

        // 不可編輯 但有參加
        if($eventAttend && $eventAttend['attendStatus'] == 1){
          $event['attendStatus'] = 'registered';
        }else if($event['fullCapacity'] == 1){
          $event['attendStatus'] = 'disable';
        }else{
          $event['attendStatus'] = 'attend';
        }
      }
    }else{
      $event['attendStatus'] = 'attend';
    }

    if($event['userNickname'] != null){
      $event['userNameShown'] = $event['userNickname'];
    }else if($event['userFirstName'] != null){
      $event['nameShown'] = $event['userFirstName'];
    }else{
      $event['nameShown'] = 'Splooter';
    }

    if($event['eventType'] == 'official'){
      $event['userPortrait'] = 0;
      $event['nameShown'] = 'Sploot 官方';
      $event['lindId'] = '@Sploot';
    }
    

    $response['data'][] = $event;
  }
}else{
  $response = [
    'status' => 'error',
    'message' => '沒有活動'
  ];
}


echo json_encode($response);
?>