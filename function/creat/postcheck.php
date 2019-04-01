<?php
session_start();
require('../../question/dbconnect.php');

//ユーザーテーブルへアクセスする
$user = $db->prepare('SELECT * FROM user_db WHERE id=?');
$user->execute(array($_SESSION['id']));
$loginuser = $user->fetch();

//直でpostcheck.phpが呼び出された場合はjoin.phpへ飛ばす
if (!isset($_SESSION['post_quiz'])) {
    header('Location: join.php');
    exit();
}

//DB登録する
if (!empty($_POST)) {
    $statement = $db->prepare('INSERT INTO mondai SET user_id=?, question=?, A1=?, A2=?, A3=?, A4=?, trueanswer=?, title=?');
    $statement->execute(array(
        $_SESSION['id'],
        $_SESSION['post_quiz']['question'],
        $_SESSION['post_quiz']['choice1'],
        $_SESSION['post_quiz']['choice2'],
        $_SESSION['post_quiz']['choice3'],
        $_SESSION['post_quiz']['choice4'],
        $_SESSION['post_quiz']['select'],
        $_SESSION['post_quiz']['title']
    ));
    unset($_SESSION['post_quiz']);     //$_SESSION['post_quiz']を空にする

    //DBに登録完了したらposted.phpへ飛ぶ
    header('Location: posted.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿確認</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="postcheck.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="row">
                <div class="col-sm-6">
                    <h1>ヘッダー</h1>
                </div>
                <div class="col-am-6 text-right">
                    <a href="../../question/index.php">トップへ戻る</a>
                </div>
            </div>
        </header>
    </div>

    <hr>

    <div class="container">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="logo">
                <h1>クイズ投稿確認画面</h1>
            </div>
            <div class="content">
                <p>下記の内容を確認して「登録ボタン」を押して下さい。</p>
                <form action="" method="post">
                    <input type="hidden" name="action" value="submit">
                    <table border="1" width="100%" height="500">
                        <tr>
                            <th width="20%">タイトル</th>
                            <td width="80%"><?php print(htmlspecialchars($_SESSION['post_quiz']['title'], ENT_QUOTES)); ?></td>
                        </tr>
                        <tr>
                            <th>問題文</th>
                            <td><?php print(htmlspecialchars($_SESSION['post_quiz']['question'], ENT_QUOTES)); ?></td>
                        </tr>
                        <tr>
                            <th>選択肢１</th>
                            <td><?php print(htmlspecialchars($_SESSION['post_quiz']['choice1'], ENT_QUOTES)); ?></td>
                        </tr>
                        <tr>
                            <th>選択肢２</th>
                            <td><?php print(htmlspecialchars($_SESSION['post_quiz']['choice2'], ENT_QUOTES)); ?></td>
                        </tr>
                        <tr>
                            <th>選択肢３</th>
                            <td><?php print(htmlspecialchars($_SESSION['post_quiz']['choice3'], ENT_QUOTES)); ?></td>
                        </tr>
                        <tr>
                            <th>選択肢４</th>
                            <td><?php print(htmlspecialchars($_SESSION['post_quiz']['choice4'], ENT_QUOTES)); ?></td>
                        </tr>
                        <tr>
                            <th>正解の選択肢</th>
                            <?php if ($_SESSION['post_quiz']['select'] === 'A1'): ?>
                                <td><?php print('選択肢１'); ?></td>
                            <?php endif; ?>
                            <?php if ($_SESSION['post_quiz']['select'] === 'A2'): ?>
                                <td><?php print('選択肢２'); ?></td>
                            <?php endif; ?>
                            <?php if ($_SESSION['post_quiz']['select'] === 'A3'): ?>
                                <td><?php print('選択肢３'); ?></td>
                            <?php endif; ?>
                            <?php if ($_SESSION['post_quiz']['select'] === 'A4'): ?>
                                <td><?php print('選択肢４'); ?></td>
                            <?php endif; ?>
                        </tr>
                    </table>
                    
                    <button class="btn btn-warning" type="button" onclick="location.href='post.php?action=rewrite'">書き直す</button>
                    <button class="btn btn-info" type="submit">クイズを投稿する</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>