<?php
session_start();
require('../question/dbconnect.php');

//postで指定しているメールアドレスがDBに存在しているか
if (!empty($_POST)) {
    $address = $db->prepare('SELECT COUNT(*) as cnt FROM user_db WHERE email=?');
    $address->execute(array($_POST['email']));
    $record = $address->fetch();
    if ($record['cnt'] < 1) {
        $error['email'] = 'Nan';
    }
}

//入力が空白など正しく記述されてるかチェック
if (!empty($_POST)) {
    if ($_POST['email'] === '') {
        $error['email'] = 'blank';
    }

    //正しく入力されたら指定されたメールアドレスにメールを送信
    if (empty($error)) {
       $_SESSION['address'] = $_POST['email'];
       header('Location: sendmail.php');
       exit();
    }
}



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワードをお忘れですか？</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="forgetpass.css">
</head>
<body>
    <div class="container">
        <header>
        　　<div class="row">
                <div class="col-sm-10">
                    <h1>ヘッダー</h2>
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
            <h2>パスワードをリセット</h2>
            <p>メールアドレスを送信するとパスワードをリセットする手順が送信されます</p>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <?php if ($error['email'] === 'blank'): ?>
                        <span class="error">メールアドレスを入力してください</span>
                    <?php endif; ?>
                    <?php if ($error['email'] === 'Nan'): ?>
                        <span class="error">指定されたメールアドレスは登録されていません</span>
                    <?php endif; ?>
                    <input class="form-control" type="email" name="email">
                </div>
                <button class="btn btn-info btn-block" type="submit">送信</button>
            </form>
        </div>
    </div>
    
    <?php print($X);?>
</body>
</html>     