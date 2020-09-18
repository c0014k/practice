<?php

if (isset($_SESSION['user'])){
	header("Location: /index.php");
	exit();
}

$array = array();
if (isset($_POST['login'],$_POST['pass'],$_POST['email'])){
	if(empty($_POST['login'])){
		$array = array(
			'status' => 'error',
			'error' => 'Вы не заполнили логин'
		);
		echo json_encode($array);
		exit();

	} elseif(mb_strlen($_POST['login']) < 2){
		$array = array(
			'status' => 'error',
			'error' => 'Логин слишком короткий'
		);
		echo json_encode($array);
		exit();

	} elseif(mb_strlen($_POST['login']) > 16) {
		$array = array(
			'status' => 'error',
			'error' => 'Логин слишком длинный'
		);
		echo json_encode($array);
		exit();
	}

	if(mb_strlen($_POST['pass']) < 5){
		$array = array(
			'status' => 'error',
			'error' => 'Пароль должен быть длиннее 4 символов'
		);
		echo json_encode($array);
		exit();
	}
	if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		$array = array(
			'status' => 'error',
			'error' => 'Введите корректный email'
		);
		echo json_encode($array);
		exit();
	}
	if(!count($array)) {
		$res = q("
			SELECT `id`
			FROM `users`
			WHERE `login` = '".es($_POST['login'])."'
			LIMIT 1
		");
		if(mysqli_num_rows($res)) {
			$array = array(
				'status' => 'error',
				'error' => 'Такой логин уже занят'
			);
			echo json_encode($array);
			exit();
		}

		$res = q("
			SELECT `id`
			FROM `users`
			WHERE `email` = '".es($_POST['email'])."'
			LIMIT 1
		");
		if(mysqli_num_rows($res)) {
			$array = array(
				'status' => 'error',
				'error' => 'Данный email уже зарегистрирован'
			);
			echo json_encode($array);
			exit();
		}
	}
}

if(!count($array)){
/*
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
*/
	$array = array(
		'status' => 'OK',
	);
	echo json_encode($array);
	exit();
}