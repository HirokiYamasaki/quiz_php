<?php
session_start();
require('../../question/dbconnect.php');

//$memos = $db->prepare('SELECT * FROM mondai where id=?');
//$memos->bindParam(1, $id, PDO::PARAM_INT);      //urlパラメータでクイズのidを指定
//$memos->execute();
//$memo = $memos->fetch();


if ($_SESSION['edit_quiz']['select'] === 'A1') {
    $select = '選択肢１';
} else if ($_SESSION['edit_quiz']['select'] === 'A2') {
    $select = '選択肢2';
} else if ($_SESSION['edit_quiz']['select'] === 'A3') {
    $select = '選択肢3';
} else if ($_SESSION['edit_quiz']['select'] === 'A4') {
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

    <link rel="stylesheet" href="editcheck.css">
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
            <h3>このクイズの編集を決定しますか？</h3>
            </div>
            <div class="">
                <table border="1" width="100%" height="500">
                    <tr>
                        <th>タイトル</th>
                        <td><?php print($_SESSION['edit_quiz']['title']); ?></td>
                    </tr>
                    <tr>
                        <th>問題文</th>
                        <td><?php print($_SESSION['edit_quiz']['question']); ?></td>
                    </tr>
                    <tr>
                        <th>選択肢１</th>
                        <td><?php print($_SESSION['edit_quiz']['choice1']); ?></td>
                    </tr>
                    <tr>
                        <th>選択肢２</th>
                        <td><?php print($_SESSION['edit_quiz']['choice2']); ?></td>
                    </tr>
                    <tr>
                        <th>選択肢３</th>
                        <td><?php print($_SESSION['edit_quiz']['choice3']); ?></td>
                    </tr>
                    <tr>
                        <th>選択肢４</th>
                        <td><?php print($_SESSION['edit_quiz']['choice4']); ?></td>
                    </tr>
                    <tr>
                        <th>正解の選択肢</th>
                        <td><?php print($select); ?></td>
                    </tr>
                </table>
            </div>
            <div class="buttom">
                <button type="buttom" class="btn btn-warning btn-block" onclick="location.href='edit-do.php'">編集する</button>
            </div>
        </div>
    </div>
    
</body>
</html>