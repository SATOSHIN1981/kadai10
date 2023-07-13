<?php

$name = $_POST['name'];
$email = $_POST['email'];
$user_id = $_POST['user_id'];
$q1 = $_POST['q1'];
$q2 = $_POST['q2'];
$q3 = $_POST['q3'];

//2. DB接続します
try {
    //ID:'root', Password: xamppは 空白 ''
    $pdo = new PDO('mysql:dbname=gs_db_kadai02;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
}

// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO
                        kadai02_table(
                            id, uid, name, q1, q2, q3
                        ) VALUES (
                            NULL, :uid, :name, :q1, :q2, :q3
                        )");

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':uid', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':q1', $q1, PDO::PARAM_INT);
$stmt->bindValue(':q2', $q2, PDO::PARAM_INT);
$stmt->bindValue(':q3', $q3, PDO::PARAM_INT);


//  3. 実行
$status = $stmt->execute();


//４．データ登録処理後
if($status === false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('ErrorMessage:'.$error[2]);
} else {
    //５．read.phpへ遷移
    $postData = array(
        'name' => $name,
        'email' => $email,
        'user_id' => $user_id,
        'q1' => $q1,
        'q2' => $q2,
        'q3' => $q3
    );
    $postString = http_build_query($postData);

    header('Location: read.php?' . $postString);
    exit();
}

?>

