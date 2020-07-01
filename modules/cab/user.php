<?php
if (!isset($_SESSION['user'])){
	header ("Location: /cab/auth");
	exit();
} else {
	if(isset($_POST['edit'])) {
		if(!empty($_POST['email'])) {
			$errors = [];
			if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = 'Введите корректный email';
			}
			if(!count($errors)) {
				$res = q("
					SELECT `id`
					FROM `users`
					WHERE `email` = '".es($_POST['email'])."'
						AND `id` != ".(int)$_SESSION['user']['id']."
					LIMIT 1
				");
				if(mysqli_num_rows($res)) {
					$errors['email'] = 'Данный email уже зарегистрирован';
				}
			}
			if(!empty($_POST['pass'])) {
				if(mb_strlen($_POST['pass']) < 5) {
					$errors['pass'] = 'Пароль должен быть длиннее 4 символов';
				} else {
					if(!count($errors)) {
						q("
							UPDATE `users` SET
							`pass`		= '".es(myHash($_POST['pass']))."',
							`email`		= '".es($_POST['email'])."',
							`sex`		= '".es($_POST['sex'])."',
							`age`		= ".(int)$_POST['age']."
							WHERE `id`  = ".(int)$_SESSION['user']['id']."
						") or exit('ОШИБКА:'.mysqli_error($link));
						$_SESSION['info'] = 'Запись была изменена';
						header("Location: /cab/user");
						exit();
					}
				}
			} else {
				if(!count($errors)) {
					q("
					UPDATE `users` SET
						`email`		= '".es($_POST['email'])."',
						`sex`		= '".es($_POST['sex'])."',
						`age`		= ".(int)$_POST['age']."
						WHERE `id`  = ".(int)$_SESSION['user']['id']."
					") or exit('ОШИБКА:'.mysqli_error($link));
					$_SESSION['info'] = 'Запись была изменена';
					header("Location: /cab/user");
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
				WHERE `id`	= ".(int)$_SESSION['user']['id']."
			") or exit('ОШИБКА:'.mysqli_error($link));

			$_SESSION['info'] = 'Запись была изменена';
			header("Location: /cab/user");
			exit();
		} else {
		$errors['photo'] = Uploader::$error;
		}
	}

	$users = q("
		SELECT *
		FROM `users`
		WHERE `id` = ".(int)$_SESSION['user']['id']."
		LIMIT 1
	") or exit(mysqli_error($link));
	$row = mysqli_fetch_assoc($users);
}