<?php
setcookie('autoauth', es(myHash($_SESSION['user']['id'].$_SESSION['user']['email'].$_SESSION['user']['login'])), time() - 60*60*24*30, '/');
setcookie('id', $_SESSION['user']['id'], time() - 60*60*24*30, '/');
setcookie('ip', $_SERVER['REMOTE_ADDR'], time() - 60*60*24*30, '/');
setcookie('useragent', $_SERVER['HTTP_USER_AGENT'], time() - 60*60*24*30, '/');

unset($_SESSION['user']);
session_unset();
session_destroy();
header("Location: /index.php");
exit();