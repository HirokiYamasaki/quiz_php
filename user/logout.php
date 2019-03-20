<?php
session_start();

$_SESSION = array();
session_destroy();
header('Location: ../question/index.php');
exit();
?>