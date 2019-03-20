<!--
kaitou.phpから問題のid(value)と選んだ選択肢の数字（$_session_number）を受け取る。
$_session_numberと問題の正解を確認し、if文で挙動を変える。
-->

<?php
require('dbconnect.php');
session_start();

$quizs = $db->prepare('SELECT * FROM mondai where id=?');
$quizs->execute(array($_SESSION['session_number']));
$quiz = $quizs->fetch();
?>

<!doctype html>
<html>
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- CSS -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<link rel="stylesheet" href="submit.css">

<title>submit.php</title>
</head>

<body>
    <div class="container">
        <header>
            <h1>header</h1>
        </header>
    </div>
    <hr>
    <div class="container">
        <div class="content">
            <div class="truefalse">
                <?php if($_SESSION['answer'] === $quiz['trueanswer']): ?>
                    <div class="result">正解です !</div>

                <?php elseif ($_SESSION['answer'] !== $quiz['trueanswer']): ?>
                    <p class="result">不正解です</p>
                
                <?php endif; ?>
            </div>
            <div class="link">
                <div class="row">
                    <div class="col-sm-8">
                        <button class="btn btn-primary" type="button" onclick="location.href='index.php'">クイズ一覧へ戻る</button>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary" type="button" onclick="location.href='answer.php?id=<?php print($_SESSION['session_number']); ?>'">同じクイズに挑戦</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>    
</html>


