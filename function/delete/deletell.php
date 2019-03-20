<?php
session_start();
require('../../question/dbconnect.php');

$id = $_REQUEST['id'];              //urlパラメーターのidを$idに代入
$_SESSION['session_number'] = $id;  //この$idは次のページでも利用するのでsession_numberへ代入

$quizs = $db->prepare('SELECT * FROM mondai where id=?');
$quizs->bindParam(1, $id, PDO::PARAM_INT);      //urlパラメータでクイズのidを指定
$quizs->execute();
$quiz = $quizs->fetch();

if ($quiz['trueanswer'] === 'A1') {
    $select = '選択肢１';
} else if ($quiz['trueanswer'] === 'A2') {
    $select = '選択肢2';
} else if ($quiz['trueanswer'] === 'A3') {
    $select = '選択肢3';
} else if ($quiz['trueanswer'] === 'A4') {
    $select = '選択肢4';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap css -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="deletell.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="row">
                <div class="col-sm-6">
                    <h1>ヘッダー</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="../../question/index.php">トップへ戻る</a>
                </div>
            </div>
        </header>
    </div>

    <hr>

    <div class="container">
        <div class="content">
            <div class="logo"> 
            <h3>このクイズを削除しますか？</h3>
            </div>
            <div class="">
                <table border="1" width="100%" height="500">
                    <tr>
                        <th>タイトル</th>
                        <td><?php print($quiz['title']); ?></td>
                    </tr>
                    <tr>
                        <th>問題文</th>
                        <td><?php print($quiz['question']); ?></td>
                    </tr>
                    <tr>
                        <th>選択肢１</th>
                        <td><?php print($quiz['A1']); ?></td>
                    </tr>
                    <tr>
                        <th>選択肢２</th>
                        <td><?php print($quiz['A2']); ?></td>
                    </tr>
                    <tr>
                        <th>選択肢３</th>
                        <td><?php print($quiz['A3']); ?></td>
                    </tr>
                    <tr>
                        <th>選択肢４</th>
                        <td><?php print($quiz['A4']); ?></td>
                    </tr>
                    <tr>
                        <th>正解の選択肢</th>
                        <td><?php print($select); ?></td>
                    </tr>
                </table>
                
            </div>
            <div class="buttom">
                <button type="buttom" class="btn btn-danger btn-block" onclick="location.href='delete-do.php'">削除する</button>
            </div>
        </div>
    </div>
    
</body>
</html>