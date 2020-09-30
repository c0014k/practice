<?php
if (isset($_SESSION['user'])){
	header("Location: /index.php");
	exit();
}

if(isset($_POST['email'],$_POST['pass'])) {
	if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		if(!empty ($_POST['pass'])) {
			$res = q("
				SELECT *
				FROM `users`
				WHERE `email` 	 = '".es($_POST['email'])."'
					AND `pass` 	 = '".es(myHash($_POST['pass']))."'
					AND `active` = 1
				LIMIT 1
			");
			if(mysqli_num_rows($res)) {
				$_SESSION['user'] = mysqli_fetch_assoc($res);
				if(isset($_POST['rem']) && $_POST['rem'] == 'on'){
					setcookie('autoauth', es(myHash($_SESSION['user']['id'].$_SESSION['user']['email'].$_SESSION['user']['login'])), time() + 60*60*24*30, '/');
					setcookie('id', $_SESSION['user']['id'], time() + 60*60*24*30, '/');
					setcookie('ip', $_SERVER['REMOTE_ADDR'], time() + 60*60*24*30, '/');
					setcookie('useragent', $_SERVER['HTTP_USER_AGENT'], time() + 60*60*24*30, '/');
					$res2 = q("
						UPDATE `users` SET
						`hash`		= '".es(myHash($_SESSION['user']['id'].$_SESSION['user']['email'].$_SESSION['user']['login']))."',
						`ip`		= '".es($_SERVER['REMOTE_ADDR'])."',
						`useragent`	= '".es($_SERVER['HTTP_USER_AGENT'])."'
						WHERE `id`	= ".$_SESSION['user']['id']."
					");
				}
				$array = array(
					'status' => 'ok'
				);
				echo json_encode($array);
				exit();
		} else {
			 $array = array(
			 	'status' => 'error',
				'error' => 'ДАННЫЙ ПОЛЬЗОВАТЕЛЬ НЕ ЗАРЕГИСТРИРОВАН'
			);
			echo json_encode($array);
			exit();
		}
	} else {
	 	$array = array(
			'status' => 'error',
			'error' => 'ПАРОЛЬ НЕ УКАЗАН'
		);
		echo json_encode($array);
		exit();
	}
} else {
	$array = array(
		'status' => 'error',
		'error' => 'ЭЛЕКТРОННЫЙ ЯЩИК ВВЕДЕН НЕВЕРНО'
	);
	echo json_encode($array);
	exit();
	}
}
