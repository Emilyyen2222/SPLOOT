<?php
// $URL = "mysql:host=34.81.45.85:3306;dbname=Sploot_db";
// $USERNAME = "root";
// $PASSWORD = "Tid10303!@2024";
// $pdo = new PDO($URL, $USERNAME, $PASSWORD);

$db_host = "127.0.0.1";
$db_user = "tibamefe_since2021";
$db_pass = "vwRBSb.j&K#E";
$db_select = "tibamefe_tid103g3";

$URL = "mysql:host=".$db_host.";dbname=".$db_select.";charset=utf8";
$pdo = new PDO($URL, $db_user, $db_pass);
?>