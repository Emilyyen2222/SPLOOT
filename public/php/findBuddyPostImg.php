<?php
include './PdoConnection.php';

$post_id = $_GET['postId'];

$sql = "
  SELECT
    post_img as postImg
  FROM HELPER_POST
  WHERE post_id = :post_id
  AND post_status = 1
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(":post_id", $post_id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch();

echo base64_encode($row['postImg']);
?>
