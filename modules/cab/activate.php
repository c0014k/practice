<?php
if (isset($_GET['hash'],$_GET['id'])) {
	q("
		UPDATE `users` SET
		`active`   = 1
		WHERE `id` = ".(int)$_GET['id']."
		AND `hash` = '".es($_GET['hash'])."'
	");
	$info = 'Вы успешно зарегистрировались';
} else {
	$info = 'Вы прошли по неверной ссылке';
}
