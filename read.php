<?php

// input.phpのURLを生成
$user_id = $_GET['user_id'];
// $user_id = $_POST['user_id'];
$inputURL = "input.php?user_id={$user_id}";


require_once("funcs.php");

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db_kadai02;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}





//２．データ取得SQL作成
// $stmt = $pdo->prepare("SELECT * FROM kadai02_table ");
// $status = $stmt->execute();

$stmt = $pdo->prepare("SELECT * FROM kadai02_table WHERE uid = :user_id");
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $view .= "<p>";
    $view .= h($result['name']) . ' : ' . getOptionLabel('q1', $result['q1']) . ' | ' . getOptionLabel('q2', $result['q2']) . ' | ' . getOptionLabel('q3', $result['q3']);
    $view .= "</p>";
  }

}
function getOptionLabel($question, $answer)
{
    switch ($question) {
        case 'q1':
            $questionLabel = "掃除の分担は？";
            break;
        case 'q2':
            $questionLabel = "洗濯の分担は？";
            break;
        case 'q3':
            $questionLabel = "料理の分担は？";
            break;
        default:
            $questionLabel = "";
            break;
    }

    switch ($answer) {
        case '1':
            $answerLabel = "あなた10割、相手0割";
            break;
        case '2':
            $answerLabel = "あなた8割、相手2割";
            break;
        case '3':
            $answerLabel = "あなた6割、相手4割";
            break;
        case '4':
            $answerLabel = "あなたと相手で半々";
            break;
        case '5':
            $answerLabel = "あなた4割、相手6割";
            break;
        case '6':
            $answerLabel = "あなた2割、相手8割";
            break;
        case '7':
            $answerLabel = "あなた0割、相手10割";
            break;
        case '8':
            $answerLabel = "その他";
            break;
        default:
            $answerLabel = "";
            break;
    }

    return "{$questionLabel}：{$answerLabel}";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>家事分担を相談そうだんしよう</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="input.php">アンケートに戻る</a>
      </div>
    </div>

    <h3>おともだちを招待</h3>
    <p>おともだちを招待するURL: <a href="<?php echo $inputURL; ?>"><?php echo $inputURL; ?></a></p>

  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
<h2>あなたとおともだちの回答</h2>
    <div class="container jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>
