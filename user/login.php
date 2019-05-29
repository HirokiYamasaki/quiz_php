<?php
session_start();
require('../question/dbconnect.php');

if (!empty($_POST)) {
    if ($_POST['username'] !== '' && $_POST['password'] !== '') {
        $login = $db->prepare('SELECT * FROM user_db WHERE email=? AND password=?');
        $login->execute(array(
            $_POST['email'],
            sha1($_POST['password'])
        ));
        $user = $login->fetch();

        if ($user) {
            $_SESSION['id'] = $user['id'];     // $_SESSION['id']へログイン中のユーザーidを代入
            $_SESSION['time'] = time();        //ログインした時刻を$_SESSION['time']へ代入
            header('Location: ../question/index.php');
            exit();
        } else {
            $error['login'] = 'faild';
        }
    } else {
        $error['login'] = 'blank';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>login</title>
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

    <div class="content">
        <h2>ログインフォーム</h2>
        <div class="content-logo">
            <p>ユーザー名とパスワードを記入してログインしてください</p>
            <p>ユーザー登録がまだの方はこちらから登録してください -><a href="join.php">新規登録</a></p>
        </div>
        <div class="koumoku">
            <?php if ($error['login'] === 'faild'): ?>
                <p class="error">メールアドレスかパスワードが間違っています。</p>
            <?php endif; ?>
            <?php if ($error['login'] === 'blank'): ?>
                <p class="error">メールアドレスとパスワードを入力してください</p>
            <?php endif; ?>

            <form  class="" action="" method="post">
                <div class="form-group form-inline">
                    <label  for="username">メールアドレス</label>
                    <input class="form-control" type="text" name="email" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)); ?>">
                </div>
                <div class="form-group form-inline">
                    <label for="password">パスワード</label>
                    <input class="form-control" type="password" name="password" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>">
                </div>
                
                <button class="btn btn-info" type="submit">ログイン</button>
                
            </form>
        </div>
    </div>
    <div class="reset">
        <a class="" href="forgetpass.php">パスワードをお忘れですか？</a>
    </div>
        
</body>
</html>