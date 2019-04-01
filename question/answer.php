<?php
require('dbconnect.php');
session_start();
$id = $_REQUEST['id'];              //urlパラメーターのidを$idに代入
$_SESSION['session_number'] = $id;  //この$idは次のページでも利用するのでsession_numberへ代入

$quizs = $db->prepare('SELECT * FROM mondai where id=?');
$quizs->bindParam(1, $id, PDO::PARAM_INT);      //urlパラメータでクイズのidを指定
$quizs->execute();
    
if (!empty($_POST)) {
    $_SESSION['answer'] = $_POST['answer'];
    header('Location: submit.php');
    exit();
}



?>
<!doctype html>
<html>
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- CSS -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<link rel="stylesheet" href="answer.css">

<title>kaitou.php</title>
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
        <div class="question">
            <?php $quiz = $quizs->fetch(); ?>
            <p class="toi"><?php print($quiz['question']); ?></p>
        </div>
        <div class="choice">
            <form action="" method="post">
                <?php $answer = ['A1','A2','A3','A4']; 
                    shuffle($answer);
                ?>
                <div class="radio">
                    <label for="a1">
                        <input id="a1" type="radio" name="answer" value="<?php echo $answer[0]; ?>"><?php print($quiz[$answer[0]]); ?>
                    </label>
                </div>
                <div class="radio">
                    <label for="a2">
                        <input id="a2" type="radio" name="answer" value="<?php echo $answer[1]; ?>"><?php print($quiz[$answer[1]]); ?>
                    </label>
                </div>
                <div class="radio">
                    <label for="a3">
                        <input id="a3" type="radio" name="answer" value="<?php echo $answer[2]; ?>"><?php print($quiz[$answer[2]]); ?>
                    </label>
                </div>
                <div class="radio">
                    <label for="a4">
                        <input id="a4" type="radio" name="answer" value="<?php echo $answer[3]; ?>"><?php print($quiz[$answer[3]]); ?>
                    </label>
                </div>
                <!--
                <label for="a1">
                    <input id="a1" type="radio" name="answer" value="<?php echo $answer[0]; ?>"><?php print($quiz[$answer[0]]); ?>
                </label>
                <label for="a2">
                    <input id="a2" type="radio" name="answer" value="<?php echo $answer[1]; ?>"><?php print($quiz[$answer[1]]); ?>
                </label>


                <input type="radio" name="answer" value="<?php echo $answer[0]; ?>"><?php print($quiz[$answer[0]]); ?><br>
                <input type="radio" name="answer" value="<?php echo $answer[1]; ?>"><?php print($quiz[$answer[1]]); ?><br>
                <input type="radio" name="answer" value="<?php echo $answer[2]; ?>"><?php print($quiz[$answer[2]]); ?><br>
                <input type="radio" name="answer" value="<?php echo $answer[3]; ?>"><?php print($quiz[$answer[3]]); ?><br>
-->
                <input type="submit" value="ファイナルアンサー？">
            </form>
        </div>
    </div>
</body>    
</html>