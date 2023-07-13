<?php
try {
    $db_name = 'gs_db_kadai02';    //データベース名
    $db_id   = 'root';      //アカウント名
    $db_pw   = '';      //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

$stmt = $pdo->prepare('SELECT * FROM kadai02_table');
$status = $stmt->execute();

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {

// ヘッダーを設定してファイルをダウンロードさせる
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="export.csv"');

// ファイルを開いてデータを書き込む
$filename = 'export.csv';
$file = fopen($filename, 'w');

// ヘッダーラインを書き込む
$header = array('ID', 'UID', 'Name', 'Question 1', 'Question 2', 'Question 3');
fputcsv($file, $header);

// データを書き込む
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // CSV行を書き込む
    $csvData = array(
        $result['id'],
        $result['uid'],
        $result['name'],
        getOptionLabel('q1', $result['q1']),
        getOptionLabel('q2', $result['q2']),
        getOptionLabel('q3', $result['q3'])
    );
    fputcsv($file, $csvData);
}

    fclose($fp);

    // ダウンロードさせる
    if (file_exists($filename)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filename));
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
        exit;
    } else {
        exit('ファイルが存在しません。');
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
