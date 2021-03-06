<?php
session_start();
require('dbconnect.php');

//ユーザーテーブルへアクセスする
$user = $db->prepare('SELECT * FROM user_db WHERE id=?');
$user->execute(array($_SESSION['id']));
$loginuser = $user->fetch();

//mondaiテーブルへアクセス
//$mondais = $db->query('SELECT * FROM mondai ORDER BY id ASC');

$counts = $db->query('SELECT COUNT(*) as cnt FROM mondai');
$count = $counts->fetch();
$max_page = ceil($count['cnt'] / 20);

$page = $_REQUEST['page'];
if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
} else {
    $page = 1;
}

$start = 20 * ($page - 1);
//userテーブルとmondaiテーブルでリレーションを張る
$posts = $db->prepare(
    'SELECT u.username, m.* 
    FROM user_db u, mondai m 
    WHERE u.id=m.user_id
    ORDER BY m.created_at ASC
    LIMIT ?, 20'
);
$posts->bindParam(1, $start, PDO::PARAM_INT);
$posts->execute();

//$_SESSION['id']が空の場合(ログインしていない時)$setにblankを代入
if (empty($_SESSION['id'])) {
    $set = 'blank';
} 
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="../css/header.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="row">
                <div class="col-sm-9">
                    <h1>ヘッダー</h1>
                </div>
                <?php if ($set === 'blank'): ?> <!-- ログインしていない状態なら -->
                    <div class="col-sm-1">
                        <a href="../user/join.php">新規登録</a>
                    </div>
                    <div class="col-sm-2">
                        <a href="../user/login.php">ログイン</a>
                    </div>
                <?php else: ?>
                    <div class="col-sm-2 col-sm-offset-1">
                        <a href="../user/logout.php">ログアウト</a>
                    </div>
                <?php endif; ?>
            </div>
        </header>
    </div>    

    <hr>

    <div class="main">
    
        <div class="menu">
            <?php if ($set === 'blank'):?>
                <p>名無しさんようこそ</p>
            <?php else: ?>
                <p><?php print($loginuser['username']); ?> さんようこそ</p>
            <?php endif; ?>

            <?php if ($set !== 'blank'): ?>
                <a href="../mypage/mypage-top.php">マイページ</a><br>
            <?php endif; ?>

            <?php if ($set === 'blank'): ?>
                <a href="../function/creat/nologin.html">クイズ作成・投稿</a>
            <?php else: ?>
                <a href="../function/creat/post.php">クイズ作成・投稿</a>
            <?php endif; ?>
        </div>
        
        <div class="content">
            <table border="1" width="84%" height="">
                <?php $quiz3 = []; ?>
                <?php while ($post = $posts->fetch()): ?>
                    <?php $quiz3[] = $post; ?>
                    <?php if (count($quiz3) === 3): ?>
                        <tr>
                            <td width="28%" height="50px"><a class="itimon" href="../question/answer.php?id=<?php echo $quiz3[0]['id']; ?>"><?php print($quiz3[0]['title']) ?><span>(<?php print($quiz3[0]['username'])?>)</span></td>
                            <td width="28%" height="50px"><a class="itimon" href="../question/answer.php?id=<?php echo $quiz3[1]['id']; ?>"><?php print($quiz3[1]['title']) ?><span>(<?php print($quiz3[1]['username'])?>)</span></td>
                            <td width="28%" height="50px"><a class="itimon" href="../question/answer.php?id=<?php echo $quiz3[2]['id']; ?>"><?php print($quiz3[2]['title']) ?><span>(<?php print($quiz3[2]['username'])?>)</span></td>
                        </tr>
                        <?php $quiz3 = []; ?>
                    <?php endif;?>
                <?php endwhile; ?>
                <?php if (count($quiz3) === 1): ?>
                    <tr>
                        <td height="50px"><a class="itimon" href="../question/answer.php?id=<?php echo $quiz3[0]['id']; ?>"><?php print($quiz3[0]['title'])?><span>(<?php print($quiz3[0]['username'])?>)</span></td>
                    </tr>
                <?php endif; ?>
                <?php if (count($quiz3) === 2): ?>
                    <tr>
                        <td height="50px"><a class="itimon" href="../question/answer.php?id=<?php echo $quiz3[0]['id']; ?>"><?php print($quiz3[0]['title'])?><span>(<?php print($quiz3[0]['username'])?>)</span></td>
                        <td height="50px"><a class="itimon" href="../question/answer.php?id=<?php echo $quiz3[1]['id']; ?>"><?php print($quiz3[1]['title'])?><span>(<?php print($quiz3[1]['username'])?>)</span></td>
                    </tr>
                <?php endif; ?>
            </table>

            <?php if ($page < $max_page): ?>
                <a class="nextpage" href="index.php?page=<?php print($page+1); ?>"><?php print($page+1); ?>ページ目へ</a>
            <?php endif; ?>
            <?php if ($page >= 2): ?>
                <a class="prevpage" href="index.php?page=<?php print($page-1); ?>"><?php print($page-1); ?>ページ目へ</a>
            <?php endif; ?>
        </div>
        
    </div>
    

    <hr class="footer-line">

    
    <div class="container">
        <footer>
            <div class="col-sm-10">
                <h1>フッター</h1>
            </div>
        </footer>
    </div>

</body>
</html>

