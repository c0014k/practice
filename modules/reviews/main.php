<?php

if(!empty($_POST['text']) && isset($_SESSION['user'])) {
	q("
		INSERT INTO `reviews` SET
		`name` 	= '".es($_SESSION['user']['login'])."',
		`text` 	= '".es($_POST['text'])."',
		`date`	= '".date("Y-m-d H:i:s")."'
	") or exit('ОШИБКА:'.mysqli_error($link));
	$_SESSION['regok'] = 'Ваш отзыв добавлен!';
	header("Location:/reviews");
	exit();
}

$reviews = q("
	SELECT * FROM `reviews` 
	ORDER BY `id` DESC
") or exit(mysqli_error($link));

if(isset($_SESSION['info'])){
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}