<?php
session_start();
require('../question/dbconnect.php');

//アカウントの重複をチェック
if (empty($error)) {
    $member = $db->prepare('SELECT COUNT(*) as cnt FROM user_db WHERE email=?');
    $member->execute(array($_POST['email']));
    $record = $member->fetch();
    if ($record['cnt'] > 0) {
        $error['email'] = 'duplicate';
    }
}

//入力が空白など正しく記述されてるかチェック
if (!empty($_POST)) {
    if ($_POST['username'] === '') {
        $error['name'] = 'blank';
    }
    if ($_POST['email'] === '') {
        $error['email'] = 'blank';
    }
    if ($_POST['password'] === '') {
        $error['password'] = 'blank';
    }
    if (strlen($_POST['password']) <= 3) {
        $error['password'] = 'length';
    }
    
    //$errorが空ならcheck.phpに飛ぶ
    if (empty($error)) {
        $_SESSION['join'] = $_POST;
        header('Location: check.php');
        exit();
    }
}


//check.phpで書き直しリンクから来た場合
if ($_REQUEST['action'] === 'rewrite') {
    $_POST = $_SESSION['join'];
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

    <link rel="stylesheet" href="join.css">
    <title>会員登録</title>
</head>
<body>
    <div class="container">
        <header>
            <div class="row">
                <div class="col-sm-10">
                    <h2>ヘッダー</h2>
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
            <h1>新規登録</h1>
            <p>会員登録するにはユーザー名とパスワード設定して下さい。</p>
            <form action="" method="post">
                <div class="name">
                    <div class="form-group form-inline">
                        <label for="username">ユーザー名</label>
                        <input class="form-control" type="text" name="username" value="<?php print(htmlspecialchars($_POST['username'], ENT_QUOTES)); ?>">
                        <?php if ($error['name'] === 'blank'): ?>
                            <p class="error">ユーザー名を入力してください</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="email">
                    <div class="form-group form-inline">
                        <label for="email">メールアドレス</label>
                        <input class="form-control" type="email" name="email" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)); ?>">
                        <?php if ($error['email'] === 'blank'): ?>
                            <p class="error">メールアドレスを入力してください</p>
                        <?php endif; ?>
                        <?php if ($error['email'] === 'duplicate'): ?>                   
                            <p class="error">指定されたメールアドレスは既に登録されています</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="password">
                    <div class="form-group form-inline">
                        <label for="password">パスワード</label>
                        <input class="form-control" type="password" name="password"  value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>">
                        <?php if ($error['password'] === 'blank'): ?>
                            <p class="error">パスワードを入力してください</p>
                        <?php endif; ?>
                        <?php if ($error['password'] === 'length'): ?>
                            <p class="error">パスワードを4文字以上で入力してください</p>
                        <?php endif; ?>
                    </div>
                </div>
                <button class="btn bnt-info" type="submit">入力内容を確認する</button>
            </form>
        </div>
    </div>
</body>
</html>