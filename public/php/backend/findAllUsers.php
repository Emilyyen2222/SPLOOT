<?php
header('Content-Type: application/json');
include '../PdoConnection.php';

$response = [];

$sql_select_user = "SELECT * FROM USER";
$stmt_select_user = $pdo->prepare($sql_select_user);
$stmt_select_user->execute();
$users = $stmt_select_user->fetchAll();

if($users){
  $response = [
    'status' => 'success',
    'data' => []
  ];
  foreach($users as $user){
    $sql_select_pet = "
    SELECT * FROM PET 
    WHERE user_id = :user_id
    AND pet_status = 1";
    $stmt_select_pet = $pdo->prepare($sql_select_pet);
    $stmt_select_pet->bindValue(':user_id', $user['user_id'], PDO::PARAM_INT);
    $stmt_select_pet->execute();
    $pets = $stmt_select_pet->fetchAll();

    $user['pets'] = [];
    foreach($pets as $pet){
      $sql_select_petHobby = "
      SELECT hobby FROM PET_HOBBY
      WHERE pet_id = :pet_id
      AND active_status = 1";
      $stmt_select_petHobby = $pdo->prepare($sql_select_petHobby);
      $stmt_select_petHobby->bindValue(':pet_id', $pet['pet_id'], PDO::PARAM_INT);
      $stmt_select_petHobby->execute();
      $petHobbies = $stmt_select_petHobby->fetchAll();

      $pet['petHobby'] = [];
      foreach($petHobbies as $hobby){
        $pet['petHobby'][] = $hobby['hobby'];
      }

      $sql_select_petSocial = "
      SELECT sociality FROM PET_SOCIAL
      WHERE pet_id = :pet_id
      AND active_status = 1";
      $stmt_select_petSocial = $pdo->prepare($sql_select_petSocial);
      $stmt_select_petSocial->bindValue(':pet_id', $pet['pet_id'], PDO::PARAM_INT);
      $stmt_select_petSocial->execute();
      $petSocials = $stmt_select_petSocial->fetchAll();

      $pet['petSocial'] = [];
      foreach($petSocials as $social){
        $pet['petSocial'][] = $social['sociality'];
      }

      $user['pets'][] = $pet;
    }


    $sql_select_subs = "
    SELECT * FROM SPLOOTBOX_SUB 
    WHERE user_id = :user_id
    AND remain_deliver_count > 0";
    $stmt_select_subs = $pdo->prepare($sql_select_subs);
    $stmt_select_subs->bindValue(':user_id', $user['user_id'], PDO::PARAM_INT);
    $stmt_select_subs->execute();
    $subs = $stmt_select_subs->fetchAll();

    $user['subs'] = [];
    foreach($subs as $sub){
      $sql_select_splootBox = "
      SELECT * FROM SPLOOTBOX 
      WHERE box_id = :box_id
      AND box_status = 1";
      $stmt_select_splootBox = $pdo->prepare($sql_select_splootBox);
      $stmt_select_splootBox->bindValue(':box_id', $sub['box_id'], PDO::PARAM_INT);
      $stmt_select_splootBox->execute();
      $splootBox = $stmt_select_splootBox->fetch();

      $sub['plan'] = $splootBox['plan'];
      $sub['period'] = $splootBox['period'];
      $sub['monthlyPrice'] = $splootBox['monthly_price'];

      $user['subs'][] = $sub;
    }


    $sql_select_posts = "
    SELECT * FROM HELPER_POST
    WHERE helper_id = :user_id
    AND post_status = 1";
    $stmt_select_posts = $pdo->prepare($sql_select_posts);
    $stmt_select_posts->bindValue(':user_id', $user['user_id'], PDO::PARAM_INT);
    $stmt_select_posts->execute();
    $posts = $stmt_select_posts->fetchAll();

    $user['buddy']['posts'] = $posts;


    $sql_select_helperAcceptDay = "
    SELECT accept_day FROM HELPER_ACCEPT_DAY
    WHERE user_id = :user_id
    AND active_status = 1";
    $stmt_select_helperAcceptDay = $pdo->prepare($sql_select_helperAcceptDay);
    $stmt_select_helperAcceptDay->bindValue(':user_id', $user['user_id'], PDO::PARAM_INT);
    $stmt_select_helperAcceptDay->execute();
    $helperAcceptDays = $stmt_select_helperAcceptDay->fetchAll();

    $user['buddy']['helperAcceptDays'] = [];
    foreach($helperAcceptDays as $acceptDay){
      $user['buddy']['helperAcceptDays'][] = $acceptDay['accept_day'];
    }


    $sql_select_helperAcceptPet = "
    SELECT accept_pet FROM HELPER_ACCEPT_PET
    WHERE user_id = :user_id
    AND active_status = 1";
    $stmt_select_helperAcceptPet = $pdo->prepare($sql_select_helperAcceptPet);
    $stmt_select_helperAcceptPet->bindValue(':user_id', $user['user_id'], PDO::PARAM_INT);
    $stmt_select_helperAcceptPet->execute();
    $helperAcceptPets = $stmt_select_helperAcceptPet->fetchAll();

    $user['buddy']['helperAcceptPets'] = [];
    foreach($helperAcceptPets as $acceptPet){
      $user['buddy']['helperAcceptPets'][] = $acceptPet['accept_pet'];
    }
    

    $sql_select_helperComment = "
    SELECT COUNT(*) as COUNT, AVG(ratings) as avgRating
    FROM HELPER_COMMENT
    WHERE helper_id = :user_id
    GROUP BY helper_id";
    $stmt_select_helperComment = $pdo->prepare($sql_select_helperComment);
    $stmt_select_helperComment->bindValue(':user_id', $user['user_id'], PDO::PARAM_INT);
    $stmt_select_helperComment->execute();
    $helperComments = $stmt_select_helperComment->fetch();

    $user['buddy']['helpeCommentCount'] = isset($helperComments['COUNT']) ? $helperComments['COUNT'] : 0;
    $user['buddy']['helpeCommentRating'] = isset($helperComments['avgRating']) ? $helperComments['avgRating'] : 0;
    
    $response['data'][] = $user;
  }

}else{
  $response = [
    'status' => 'error',
    'message' => '沒有使用者'
  ];
}

echo json_encode($response);

?>