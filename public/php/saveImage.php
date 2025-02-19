<?php
header("Content-Type: application/json; charset=UTF-8");


if(isset($_FILES['file'])){
    $file = $_FILES['file'];
    // 設定儲存路徑，假設 ../image 為目標資料夾
    $uploadDir = __DIR__ . "/../buddyUserImg/";
    // $uploadDir = './';
    // 取得原始檔名
    $fileName = uniqid() . "_" . basename($file["name"]); 
    $targetPath = $uploadDir . $fileName;

    // 可加入檔名衝突處理，這裡示範直接覆蓋
    if(move_uploaded_file($file['tmp_name'], $targetPath)){
        echo json_encode(["success" => true, "imagePath" => $fileName]);
    } else {
        echo json_encode(["success" => false, "message" => "檔案上傳失敗"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "無檔案上傳"]);
}



?>
