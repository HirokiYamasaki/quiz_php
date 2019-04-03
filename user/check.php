<?php
session_start();
require('../question/dbconnect.php');

//直でcheck.phpが呼び出された場合はjoin.phpへ飛ばす
if (!isset($_SESSION['join'])) {
    header('Location: join.php');
    exit();
}

//DB登録する
if (!empty($_POST)) {
    $statement = $db->prepare('INSERT INTO user_db SET username=?, email=?, password=?, created_at=NOW()');
    $statement->execute(array(
        $_SESSION['join']['username'],
        $_SESSION['join']['email'],
        sha1($_SESSION['join']['password'])
    ));

    //DBに登録完了したらkanryou.phpへ飛ぶ
    header('Location: completion.php');
    exit();
}
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

    <link rel="stylesheet" href="check.css">
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

    <div class="content">
        <h1>入力確認フォーム</h1>
        <p>下記の内容を確認して「登録ボタン」を押して下さい。</p>
        <form action="" method="post">
            <input type="hidden" name="action" value="submit">
            <table border="1" width="100%">
                <tr>
                    <th width="30%" height="40">ユーザー名</th>
                    <td width="70%" height="40"><?php print(htmlspecialchars($_SESSION['join']['username'], ENT_QUOTES)); ?></td>
                </tr>
                <tr>
                    <th width="30%" height="40">メールアドレス</th>
                    <td width="30%" height="40"><?php print(htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)); ?></td>
                </tr>
                <tr>
                    <th width="30%" height="40">パスワード</th>
                    <td width="30%" height="40">表示されません</td>
                </tr>
            </table>

            <button type="button" class="btn btn-secondary" onclick="location.href='join.php?action=rewrite'">書き直す</button>
            <button type="submit" class="btn btn-primary">登録する</button>
        </form>
    </div>
    
</body>
</html>

