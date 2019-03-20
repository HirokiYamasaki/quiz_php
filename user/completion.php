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

    <link rel="stylesheet" href="kanryou.css">
</head>
<body>
    <div class="container">
        <div class="col-sm-8 col-sm-offset-3 message">
            <h1>ユーザー登録が完了しました！</h1>
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-2 login">
                <button class="btn btn-info" type="button" onclick="location.href='login.php'">早速ログインする</button>
            </div>
            <div class="col-sm-4 notlogin">
                <button class="btn btn-info" type="button" onclick="location.href='../question/index.php'">ログインせずに利用する</button>
            </div>
        </div>
    </div>
</body>
</html>


