<?php
header('Content-Type: application/json');
include './PdoConnection.php';

$response = ['response'];

$sql_select = "
  SELECT
    post_id AS postId,
    helper_id AS helperId,
    service,
    title,
    service_city AS serviceCity,
    service_district AS serviceDistrict,
    service_time_start AS serviceTimeStart,
    service_time_end AS serviceTimeEnd,
    description,
    post_img
  FROM HELPER_POST
  WHERE post_status = 1;
";

$stmt_select = $pdo->prepare($sql_select);
$stmt_select->execute();
$posts = $stmt_select->fetchAll();

if ($posts) {
    $response = [
        'status' => 'success',
        'data' => []
    ];

    foreach($posts as $post){
      switch($post['service']){
        case '散步陪伴':
          $post['serviceType'] = 'walkies';
          break;
        case '到府照顧':
          $post['serviceType'] = 'homeCare';
          break;
        case '友善寄宿':
          $post['serviceType'] = 'fostering';
          break;
        case '寵物計程車':
          $post['serviceType'] = 'petDrop';
          break;
      }

      $post['acceptDays'] = [];
      $post['acceptPets'] = [];

      $sql_select_acceptDays = "
      SELECT accept_day FROM HELPER_ACCEPT_DAY
      WHERE post_id = :post_id
      AND active_status = 1
      ";
      $stmt_select_acceptDays = $pdo->prepare($sql_select_acceptDays);
      $stmt_select_acceptDays->bindValue(':post_id', $post['postId'], PDO::PARAM_INT);
      $stmt_select_acceptDays->execute();
      $acceptDays = $stmt_select_acceptDays->fetchAll();

      $sql_select_acceptPets = "
      SELECT accept_pet FROM HELPER_ACCEPT_PET
      WHERE post_id = :post_id
      AND active_status = 1
      ";
      $stmt_select_acceptPets = $pdo->prepare($sql_select_acceptPets);
      $stmt_select_acceptPets->bindValue(':post_id', $post['postId'], PDO::PARAM_INT);
      $stmt_select_acceptPets->execute();
      $acceptPets = $stmt_select_acceptPets->fetchAll();

      foreach($acceptDays as $day){
        $post['acceptDays'][] = $day['accept_day'];
      };
      foreach($acceptPets as $pet){
        $post['acceptPets'][] = $pet['accept_pet'];
      };

      $response['data'][] = $post;
    }
} else {
    $response = [
        'status' => 'error',
        'message' => '沒有貼文'
    ];
}

echo json_encode($response);
?>
