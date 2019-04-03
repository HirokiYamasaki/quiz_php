<?php
session_start();

mb_language("Japanese");
mb_internal_encoding('UTF-8');
$to = $_SESSION['join']['email'];
$title = '登録ありがとうございます！！';
$content = 'この度は、○○○○(サービス名)に登録してくださり誠にありがとうございます。
            ○○○○(サービス名)では誰でも簡単にクイズを作成・投稿、回答できるサービスです。';

mb_send_mail($to, $title, $content);    //登録完了メールを送信
unset($_SESSION['join']);     //$_SESSION['join]を空にする
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kanryou</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="completion.css">
    <link rel="stylesheet" href="../css/header.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="row">
                <div class="col-sm-10">
                    <h1>ヘッダー</h1>
                </div>
                <div class="col-sm-2">
                    <a href="../question">トップへ戻る</a>
                </div>
            </div>
        </header>
    </div>

    <hr>

    <div class="container">
        <h2>ユーザー登録が完了しました！</h2>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-2 login">
                <button class="btn btn-info" type="button" onclick="location.href='login.php'">早速ログインする</button>
            </div>
            <div class="col-sm-4 notlogin">
                <button class="btn btn-info" type="button" onclick="location.href='../question/index.php'">ログインせずに利用する</button>
            </div>
        </div>
    </div>
</body>
</html>


