<?php
session_start();
require('../question/dbconnect.php');

//ユーザーテーブルへアクセスする
$user = $db->prepare('SELECT * FROM user_db WHERE id=?');
$user->execute(array($_SESSION['id']));
$loginuser = $user->fetch();

//mondaiテーブルへアクセス
$mondais = $db->prepare('SELECT * FROM mondai WHERE user_id=?');
$mondais->execute(array($_SESSION['id']));

//直でmypage-top.phpが呼び出された場合はjoin.phpへ飛ばす
if (!isset($_SESSION['id'])) {
    header('Location: ../question/');
    exit();
}

//$_SESSION['id']

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>

    <!-- bootstrap css -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="mypage-top.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="row">
                <div class="col-sm-6">
                    <h1>header</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="../question/index.php">トップへ戻る</a>
                </div>
            </div>
        </header>
    </div>

    <hr>

    <div class="container">
        <div class="content">
            <div class="loginusername">
                <h2><?php print($loginuser['username']); ?></h2>
            </div>
            <div class="">
                <div class="option">
                    <a href="../function/creat/post.php">クイズ作成・投稿</a>
                    <a href="../function/edit/select-edit.php">クイズ編集</a>
                    <a href="../function/delete/select-delete.php">クイズ削除</a>
                </div>
                <?php while ($mondai = $mondais->fetch()): ?>
                    <ul>
                        <li class="one_quiz"><?php print($mondai['title']) ?></li>
                    </ul>
                    <?php $i = $i +1 ?>
                <?php endwhile; ?>
            </div>
            
        </div>
    </div>

    
</body>
</html>