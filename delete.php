<?php
session_start();
require_once('funcs.php');
loginCheck();

if($_SESSION['kanri_flg'] !== 1){
    header('Location: select.php');
    exit();
}


//1. POSTデータ取得
$id= $_GET['id'];

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('DELETE FROM kadai02_table WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//4．データ表示
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    header('Location: select.php') ;
    exit;
}





