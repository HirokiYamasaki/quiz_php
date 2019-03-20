<?php
try {
    $db = new PDO('mysql:dbname=sampledb;host=127.0.0.1;charset=utf8', 'username', 'password');
} catch (PDOexception $e) {
    print('DB接続エラー：' . $e->getMessage());
}
?>