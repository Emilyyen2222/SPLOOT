
<?php
header('Content-Type: application/json');
include './PdoConnection.php';
session_start();

$postData = json_decode(file_get_contents("php://input"), true);


$user_id = $_SESSION['userId'];
$first_name = $postData['firstName'];
$last_name = $postData['lastName'];
$nickname = $postData['nickname'];
$gender = $postData['gender'];
$birth_date = $postData['birthDate'];
$line_id = $postData['lineId'];
$phone = $postData['phone'];
$address_city = $postData['address_city'];
$address_district = $postData['address_district'];
$address_street = $postData['address_street'];
$portrait = $postData['portrait'];

$response = [];

$sql_update = "
  update USER
  set
    first_name = :first_name,
    last_name = :last_name,
    nickname = :nickname,
    gender = :gender,
    birth_date = :birth_date,
    line_id = :line_id,
    phone = :phone,
    address_city = :address_city,
    address_district = :address_district,
    address_street = :address_street,
    portrait = :portrait,
    last_updated_date = CURRENT_TIMESTAMP
  WHERE 
    user_id = :user_id
";

// 🔥 確保前端真的有傳 `birthDate`
file_put_contents('php_debug.log', print_r($postData, true)); // ✅ 記錄傳輸的 JSON

if (!isset($postData['birthDate'])) {
    echo json_encode([
        "status" => "error",
        "message" => "birthDate is missing"
    ]);
    exit;
}

// 🔥 確保 `birthDate` 是可用的值
$birth_date = !empty($postData['birthDate']) ? $postData['birthDate'] : NULL;


$stmt_update = $pdo->prepare($sql_update);
$stmt_update->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt_update->bindValue(':first_name', $first_name, PDO::PARAM_STR);
$stmt_update->bindValue(':last_name', $last_name, PDO::PARAM_STR);
$stmt_update->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$stmt_update->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt_update->bindValue(':birth_date', $birth_date, PDO::PARAM_STR);
$stmt_update->bindValue(':line_id', $line_id, PDO::PARAM_STR);
$stmt_update->bindValue(':phone', $phone, PDO::PARAM_STR);
$stmt_update->bindValue(':address_city', $address_city, PDO::PARAM_STR);
$stmt_update->bindValue(':address_district', $address_district, PDO::PARAM_STR);
$stmt_update->bindValue(':address_street', $address_street, PDO::PARAM_STR);
$stmt_update->bindValue(':portrait', $portrait, PDO::PARAM_INT);
$stmt_update->execute();

if($stmt_update->rowCount() > 0){
  $response = [
    'status' => 'success'
  ];
}else{
  $response = [
    'status' => 'error',
    'message' => '會員資料更新失敗'
  ];
}


echo json_encode($response);
?>