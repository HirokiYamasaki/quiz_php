<?php
session_start();
require('../../question/dbconnect.php');

$mondais = $db->prepare('SELECT * FROM mondai WHERE user_id=?');
$mondais->execute(array($_SESSION['id']));

$id = $_REQUEST['id'];              //urlパラメーターのidを$idに代入
$_SESSION['session_number'] = $id;  //この$idは次のページでも利用するのでsession_numberへ代入
                          

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集するクイズを選択</title>

    <!-- bootstrap css -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="select-edit.css">
    <link rel="stylesheet" href="../../css/header.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="row">
                <div class="col-sm-6">
                    <h1>header</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="../../question/">トップへ戻る</a>
                </div>
            </div>
        </header>
    </div>

    <hr>
    <div class="container">
        <div class="content">
            <div class="">
                <div class="">
                    <h2>編集するクイズを選んで下さい</h2>
                </div>
                <div class="center">
                    <?php while ($mondai = $mondais->fetch()): ?>
                        <ul>
                            <li class="one_quiz"><a href="editll.php?id=<?php echo $mondai['id']; ?>"><?php print($mondai['title']) ?></a></li>
                        </ul>
                        <?php $i = $i +1 ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

