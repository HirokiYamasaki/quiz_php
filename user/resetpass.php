<?php
session_start();

//urlからemailを取得
if(isset($_GET['email'])) {
    $email = $_GET['email'];
} 

//正しく入力されているかチェック
if (!empty($_POST)) {
    if (strlen($_POST['password']) <= 3) {
        $error['password'] = 'length';
    }
    if (strlen($_POST['confirm']) <= 3) {
        $error['confirm'] = 'length';
    }
    if (empty($error['password']) and empty($error['confirm']) and $_POST['password'] !== $_POST['confirm']) {
        $error['unmatch'] = 'unmatch';
    } 

    //エラーが無ければ次の処理へ
    if (empty($error)) {
        $_SESSION["new_password"] = $_POST['password'];
        $_SESSION['email'] = $email;
        header('Location: passupdate.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワードリセット</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="http://aonami.secret.jp/quiz/css/header.css">
    <link rel="stylesheet" href="resetpass.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="row">
                <div class="col-sm-10">
                    <h1>ヘッダー</h1>
                </div>
                <div class="col-sm-2">
                    <a href="http://aonami.secret.jp/quiz/question/">トップへ戻る</a>
                </div>
            </div>
        </header>
    </div>    
    
    <hr>

    <div class="container">
        <div class="content">
            <h2>パスワード再設定</h2>
            <p>メールアドレス：<span><?php echo $email; ?></span></p>
            <?php if ($error['unmatch'] === 'unmatch'): ?>
                <span class="error">パスワードが一致していません</span>
            <?php endif; ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="password">新しいパスワード（4文字以上）</label>
                    <?php if ($error['password'] === 'length'): ?>
                        <span class="error">4文字以上でパスワード入力してください</span>
                    <?php endif; ?>
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="form-group">
                    <label for="confirm">パスワードを再入力</label>
                    <?php if ($error['confirm'] === 'length'): ?>
                        <span class="error">4文字以上でパスワード入力してください</span>
                    <?php endif; ?>
                    <input class="form-control" type="password" name="confirm">
                </div>
                <button class="btn btn-info btn-block" type="submit">送信</button>
            </form>
        </div>
    </div>
    
</body>
</html>