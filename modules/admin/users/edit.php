<?php
if(isset($_POST['edit'])) {
	if(!empty($_POST['login'] && $_POST['email'])) {
		$errors = array();
		if(mb_strlen($_POST['login']) < 2){
			$errors['login'] = 'Логин слишком короткий';
		} elseif(mb_strlen($_POST['login']) > 16) {
			$errors['login'] = 'Логин слишком длинный';
		}
		if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
			$errors['email'] = 'Введите корректный email';
		}
		if(!count($errors)) {
			$res = q("
				SELECT `id`
				FROM `users`
				WHERE `login` = '".es($_POST['login'])."'
					AND `id` !=	".(int)$_GET['id']."
				LIMIT 1
			");
			if(mysqli_num_rows($res)) {
				$errors['login'] = 'Такой логин уже занят';
			}
			$res = q("
				SELECT `id`
				FROM `users`
				WHERE `email` = '".es($_POST['email'])."'
					AND `id` != ".(int)$_GET['id']."
				LIMIT 1
			");
			if(mysqli_num_rows($res)) {
				$errors['email'] = 'Данный email уже зарегистрирован';
			}
		}
		if(!empty($_POST['pass'])){
			if(mb_strlen($_POST['pass']) < 5){
				$errors['pass'] = 'Пароль должен быть длиннее 4 символов';
			} else {
				if(!count($errors)) {
					q("
						UPDATE `users` SET
						`login`		= '".es($_POST['login'])."',
						`pass`		= '".es(myHash($_POST['pass']))."',
						`email`		= '".es($_POST['email'])."',
						`sex`		= '".es($_POST['sex'])."',
						`age`		= ".(int)$_POST['age'].",
						`active`	= ".(int)$_POST['active'].",
						`access`	= ".(int)$_POST['access']."
						WHERE `id`  = ".(int)$_GET['id']."
					") or exit('ОШИБКА:'.mysqli_error($link));

					$_SESSION['info'] = 'Запись была изменена';
					header("Location: /admin/users");
					exit();
				}
			}
		} else {
			if(!count($errors)) {
				q("
					UPDATE `users` SET
					`login`		= '".es($_POST['login'])."',
					`email`		= '".es($_POST['email'])."',
					`sex`		= '".es($_POST['sex'])."',
					`age`		= ".(int)$_POST['age'].",
					`active`	= ".(int)$_POST['active'].",
					`access`	= ".(int)$_POST['access']."
					WHERE `id`  = ".(int)$_GET['id']."
				") or exit('ОШИБКА:'.mysqli_error($link));

				$_SESSION['info'] = 'Запись была изменена';
				header("Location: /admin/users");
				exit();
			}
		}
	}
}
if(isset($_POST['editavatar'])) {
	if(Uploader::upload($_FILES['file'])) {
		Uploader::resize(500, 500, '500x500');
		Uploader::resize(100, 100, '100x100');
		$filename = Uploader::$filename;
		q("
			UPDATE `users` SET
			`img`		= '".$filename."'
			WHERE `id`	= ".(int)$_GET['id']."
		") or exit('ОШИБКА:'.mysqli_error($link));

		$_SESSION['info'] = 'Запись была изменена';
		header("Location: /admin/users/edit?id=".(int)$_GET['id']."");
		exit();
	} else {
		$errors['photo'] = Uploader::$error;
	}
}

$users = q("
	SELECT *
	FROM `users`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
") or exit(mysqli_error($link));

if(!mysqli_num_rows($users)) {
	$_SESSION['info'] = 'Данного пользователя не существует';
	header("Location: /admin/users");
	exit();
}
$row = mysqli_fetch_assoc($users);
