<?php
header('Content-Type: application/json');
include './PdoConnection.php';
session_start();
$postData = json_decode(file_get_contents("php://input"), true);//前端傳回php的東西

$user_id = $_SESSION['userId'];
$response = [];//傳回前端的資料

$sql = "
  select 
    sbc.pet_name as petName,
    sbs.user_id as userId,
    sb.plan as plan,
    sb.period as period,
    sb.monthly_price as monthlyPrice,
    sbs.remain_deliver_count as remainDeliverCount,
    sbs.created_date as createdDate
from SPLOOTBOX_SUB sbs
JOIN SPLOOTBOX sb on sbs.box_id = sb.box_id
JOIN SPLOOTBOX_CARD sbc on  sbs.sub_id = sbc.sub_id
WHERE user_id = :user_id;
";



$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, pdo::PARAM_INT);
$stmt->execute();
$splootBoxSubs = $stmt->fetchAll();

if($splootBoxSubs){//所有訂閱資料
    $response = [
        'status' => 'success',
        'data' => [] //放成功的訂閱資料
    ];
    foreach($splootBoxSubs as $sub){
        $response['data'][] = $sub;
    }
}else{
    $response = [
        'status' => 'error',
        'message' => '沒有訂閱紀錄'
    ];
}


echo json_encode($response);
?>