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
<link rel="stylesheet" href="answer.css">

<title>kaitou.php</title>
</head>

<body>
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
                <input type="radio" name="answer" value="<?php echo $answer[0]; ?>"><?php print($quiz[$answer[0]]); ?><br>
                <input type="radio" name="answer" value="<?php echo $answer[1]; ?>"><?php print($quiz[$answer[1]]); ?><br>
                <input type="radio" name="answer" value="<?php echo $answer[2]; ?>"><?php print($quiz[$answer[2]]); ?><br>
                <input type="radio" name="answer" value="<?php echo $answer[3]; ?>"><?php print($quiz[$answer[3]]); ?><br>
                <input type="submit" value="ファイナルアンサー？">
            </form>
        </div>
    </div>
</body>    
</html>