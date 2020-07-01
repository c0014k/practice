<?php

if (isset($_SESSION['user'])){
	header("Location: /index.php");
	exit();
}

if (isset($_POST['login'],$_POST['pass'],$_POST['email'])){
	$errors = array();
	if(empty($_POST['login'])){
		$errors['login'] = 'Вы не заполнили логин';
	} elseif(mb_strlen($_POST['login']) < 2){
		$errors['login'] = 'Логин слишком короткий';
	} elseif(mb_strlen($_POST['login']) > 16) {
		$errors['login'] = 'Логин слишком длинный';
	}

	if(mb_strlen($_POST['pass']) < 5){
		$errors['pass'] = 'Пароль должен быть длиннее 4 символов';
	}
	if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		$errors['email'] = 'Введите корректный email';
	}

	if(!count($errors)) {
		$res = q("
			SELECT `id`
			FROM `users`
			WHERE `login` = '".es($_POST['login'])."'
			LIMIT 1
		");
		if(mysqli_num_rows($res)) {
			$errors['login'] = 'Такой логин уже занят';
		}
		$res = q("
			SELECT `id`
			FROM `users`
			WHERE `email` = '".es($_POST['email'])."'
			LIMIT 1
		");
		if(mysqli_num_rows($res)) {
			$errors['email'] = 'Данный email уже зарегистрирован';
		}
	}

	if(!count($errors)){
		q("
			INSERT INTO `users` SET
			`login`	= '".es($_POST['login'])."',
			`pass`	= '".es(myHash($_POST['pass']))."',
			`email`	= '".es($_POST['email'])."',
			`age`	= ".(int)$_POST['age'].",
			`hash`	= '".es(myHash($_POST['login'].$_POST['email']))."'
		");
		$id = mysqli_insert_id($link);
		$_SESSION['regok'] = 'Мы отправили на ваш email ссылку для подтверждения регистрации. Пройдите по ней.';
		Mail::$to = $_POST['email'];
		Mail:: $subject = 'Вы зарегистрировались на сайте';
		Mail::$text = 'Пройдите по ссылке для активации вашего аккаунта:'.Core::$DOMAIN.'index.php?module=cab&page=activate&id='.$id.'&hash='.myHash($_POST['login'].$_POST['email']).'';
		Mail::send();
		header("Location:/cab/registration");
		exit();
	}
}