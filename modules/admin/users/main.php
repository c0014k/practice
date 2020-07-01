<?php
if(isset($_POST['delete']) && isset($_POST['ids'])) {
	foreach($_POST['ids'] as $k=>$v) {
		$_POST['ids'][$k] = (int)$v;
	}
	$ids = implode(',',$_POST['ids']);
	q("
		DELETE FROM `users`
		WHERE `id` IN (".$ids.")	
	") or exit(mysqli_error($link));

	$_SESSION['info'] = 'Выбранные пользователи удалены';
	header("Location: /admin/users");
	exit();
}

if(isset($_GET['id'])){
	$users = q(" 
		SELECT *
		FROM `users`
		WHERE `id` = ".(int)$_GET['id']."
		LIMIT 1
	");
} else {
	$users = q("
		SELECT *
		FROM `users`
		ORDER BY `id` ASC
	");
}

if(!empty($_POST['search'])){
	$sr = $_POST['search'];
	$search = q("
		SELECT *
		FROM `users`
		WHERE `login` LIKE '%$sr%'
	");
}


if(isset($_SESSION['info'])){
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}