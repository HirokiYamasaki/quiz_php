<?php
session_start();
require('../../question/dbconnect.php');


//if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id']) && isset($_REQUEST['memo'])) {
$statement = $db->prepare('UPDATE mondai SET title=?, question=?, A1=?, A2=?, A3=?, A4=?, trueanswer=? WHERE id=?');
$statement->execute(array(
    $_SESSION['edit_quiz']['title'],
    $_SESSION['edit_quiz']['question'],
    $_SESSION['edit_quiz']['choice1'],
    $_SESSION['edit_quiz']['choice2'],
    $_SESSION['edit_quiz']['choice3'],
    $_SESSION['edit_quiz']['choice4'],
    $_SESSION['edit_quiz']['select'],
    $_SESSION['session_number']));
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

    <link rel="stylesheet" href="../creat/posted.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="message">
                クイズが編集されました。
            </div>
            <div class="link">
                <a href="../../question/index.php">トップページへ戻る</a>
            </div>
        </div>
    </div>
</body>
</html>