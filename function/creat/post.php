<?php
session_start();
require('../../question/dbconnect.php');

//ログインしていない状態で呼び出された場合はindex.phpへ飛ばす
if (!isset($_SESSION['id'])) {
    header('Location: ../../question/');
    exit();
}

//ユーザーテーブルへアクセスする
$user = $db->prepare('SELECT * FROM user_db WHERE id=?');
$user->execute(array($_SESSION['id']));
$loginuser = $user->fetch();

//入力が空白など正しく記述されてるかチェック
if (!empty($_POST)) {
    if ($_POST['title'] === '') {
        $error['title'] = 'blank';
    }
    if ($_POST['question'] === '') {
        $error['question'] = 'blank';
    }
    if ($_POST['choice1'] === '') {
        $error['choice1'] = 'blank';
    }
    if ($_POST['choice2'] === '') {
        $error['choice2'] = 'blank';
    }
    if ($_POST['choice3'] === '') {
        $error['choice3'] = 'blank';
    }
    if ($_POST['choice4'] === '') {
        $error['choice4'] = 'blank';
    }
    if ($_POST['select'] === 'nan') {
        $error['select'] = 'blank';
    }
    
    
    //$errorが空ならpostcheck.phpに飛ぶ
    if (empty($error)) {
        $_SESSION['post_quiz'] = $_POST;
        header('Location: postcheck.php');
        exit();
    }
}

//check.phpで書き直しリンクから来た場合
if ($_REQUEST['action'] === 'rewrite') {
    $_POST = $_SESSION['post_quiz'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>クイズ作成</title>

    <!-- bootstrap css -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="post.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="row">
                <div class="col-sm-6">
                    <h1>ヘッダー</h1>
                </div>
                <div class="col-am-6 align-right">
                    <a href="../../question/index.php">トップへ戻る</a>
                </div>
            </div>
        </header>
    </div>

    <hr>
    
    <div class="container">
        <div class="content">
            <h2>クイズ作成フォーム</h2>
            <form action="" method="post">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group">
                        <label for="title">クイズのタイトル</label>
                        <?php if ($error['title'] === 'blank'): ?>
                            <div class="error">タイトルを入力してください</div>
                        <?php endif; ?>
                        <input class="form-control" type="text" name="title" value="<?php print(htmlspecialchars($_POST['title'], ENT_QUOTES)); ?>">
                    </div>
                    <div class="form-group">
                        <label for="question">問題文</label>
                        <?php if ($error['question'] === 'blank'): ?>
                            <div class="error">問題文を入力してください</div>
                        <?php endif; ?>
                        <textarea name="question" cols="30" rows="10" class="form-control"><?php print(htmlspecialchars($_POST['question'], ENT_QUOTES)); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="choice1">選択肢1</label>
                        <?php if ($error['choice1'] === 'blank'): ?>
                            <div class="error">選択肢1を入力してください</div>
                        <?php endif; ?>
                        <textarea class="form-control" name="choice1"  cols="30" rows="3"><?php print(htmlspecialchars($_POST['choice1'], ENT_QUOTES)); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="choice2">選択肢2</label>
                        <?php if ($error['choice2'] === 'blank'): ?>
                            <div class="error">選択肢2を入力してください</div>
                        <?php endif; ?>
                        <textarea class="form-control" name="choice2"  cols="30" rows="3"><?php print(htmlspecialchars($_POST['choice2'], ENT_QUOTES)); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="choice3">選択肢3</label>
                        <?php if ($error['choice3'] === 'blank'): ?>
                            <div class="error">選択肢3を入力してください</div>
                        <?php endif; ?>
                        <textarea class="form-control" name="choice3"  cols="30" rows="3"><?php print(htmlspecialchars($_POST['choice3'], ENT_QUOTES)); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="choice4">選択肢4</label>
                        <?php if ($error['choice4'] === 'blank'): ?>
                            <div class="error">選択肢4を入力してください</div>
                        <?php endif; ?>
                        <textarea class="form-control" name="choice4"  cols="30" rows="3"><?php print(htmlspecialchars($_POST['choice4'], ENT_QUOTES)); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="select">正解の選択肢</label>
                        <?php if ($error['select'] === 'blank'): ?>
                            <div class="error">正答の選択肢を選択してください。</div>
                        <?php endif; ?>
                        <select name="select" class="form-control">
                            <option value="nan">選択してください</option>
                            <option value="A1" <?php if ($_SESSION['post_quiz']['select'] === 'A1'){echo 'selected' ;} ?>>選択肢1</option>
                            <option value="A2" <?php if ($_SESSION['post_quiz']['select'] === 'A2'){echo 'selected' ;} ?>>選択肢2</option>
                            <option value="A3" <?php if ($_SESSION['post_quiz']['select'] === 'A3'){echo 'selected' ;} ?>>選択肢3</option>
                            <option value="A4" <?php if ($_SESSION['post_quiz']['select'] === 'A4'){echo 'selected' ;} ?>>選択肢4</option>
                        </select>
                    </div>

                    
                    <button class="btn btn-info" type="submit">確認画面へ</button>
                </div>
            </form>
        </div>
    </div>

    <hr>
    
</body>
</html>