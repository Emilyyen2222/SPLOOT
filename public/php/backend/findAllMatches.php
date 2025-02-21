<?php
header('Content-Type: application/json');
include '../PdoConnection.php';

$response = [];

$sql_select_match = "SELECT * FROM MATCH_STATUS";
$stmt_select_match = $pdo->prepare($sql_select_match);
$stmt_select_match->execute();
$matches = $stmt_select_match->fetchAll();

// if($matches){
  $response = [
    'status' => 'success',
    'data' => []
  ];

  foreach($matches as $match){
    $sql_select_userName = "SELECT first_name, last_name FROM USER WHERE user_id = :user_id";
    $stmt_select_userName = $pdo->prepare($sql_select_userName);

    $stmt_select_userName->bindValue('user_id', $matches['user_id'], PDO::PARAM_INT);
    $stmt_select_userName->execute();
    $userName = $stmt_select_userName->fetch();

    $stmt_select_userName->bindValue('user_id', $matches['matcher_id'], PDO::PARAM_INT);
    $stmt_select_userName->execute();
    $matcherName = $stmt_select_userName->fetch();

    if(isset($userName['last_name']) && isset($userName['first_name'])){
      $match['userName'] = $userName['last_name'].$userName['first_name'];
    }else{
      $match['userName'] = '';
    }

    if(isset($matcherName['last_name']) && isset($matcherName['first_name'])){
      $match['matcherName'] = $matcherName['last_name'].$matcherName['first_name'];
    }else{
      $match['matcherName'] = '';
    }

    $response['data'][] = $match;
  }
  

// }else{
//   $response = [
//     'status' => 'error',
//     'message' => '沒有配對資料'
//   ];
// }

echo json_encode($response);

?>