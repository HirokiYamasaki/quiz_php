<?php
session_start();

//
//直でこのページが呼び出された場合はjoin.phpへ飛ばす
if (!isset($_SESSION['address'])) {
    header('Location: join.php');
    exit();
}

//パスワードリセットメールを送信
mb_language("Japanese");
mb_internal_encoding("UTF-8");
$to = $_SESSION['address'];
$title = 'パスワード再設定';
$content = '以下のリンクからパスワードを再設定して下さい'."\n";
$content .= "http://aonami.secret.jp/quiz/user/resetpass.php?email=$to";

mb_send_mail($to, $title, $content);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="sendmail.css">
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
        <div class="content">
            <h2>パスワードリセット</h2>
            <div class="message">
                <p><span class="session"><?php print($_SESSION['address']); ?></span>へメールを送信しました。メールのリンクからパスワードの再設定をしてください</p>
            </div>
        </div>
    </div>
    
</body>
</html>