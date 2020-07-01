<?php
if(isset($_SESSION['user'])){
	$res = q("
		SELECT *
		FROM `users`
		WHERE `id` = ".(int)$_SESSION['user']['id']."
		LIMIT 1
	");
	$_SESSION['user'] = mysqli_fetch_assoc($res);
	q("
		UPDATE `users` SET
		`lastactivitydate`	= '".date("Y-m-d H:i:s")."'
		WHERE `id` = ".(int)$_SESSION['user']['id']."
		LIMIT 1
	");
	if($_SESSION['user']['active'] != 1) {
		include './'.Core::$CONT.'./cab/logout.php';
	}
} elseif(isset($_COOKIE['autoauth'])){
	$aa = q("
		SELECT *
		FROM `users`
		WHERE `hash`		= '".es($_COOKIE['autoauth'])."'
			AND `id`		= ".(int)$_COOKIE['id']."
			AND `ip`		= '".es($_SERVER['REMOTE_ADDR'])."'
			AND	`useragent`	= '".es($_SERVER['HTTP_USER_AGENT'])."'
		LIMIT 1
	");
	q("
		UPDATE `users` SET
		`lastactivitydate`	= '".date("Y-m-d H:i:s")."'
		WHERE `hash`		= '".es($_COOKIE['autoauth'])."'
			AND `id`		= ".(int)$_COOKIE['id']."
			AND `ip`		= '".es($_SERVER['REMOTE_ADDR'])."'
			AND	`useragent`	= '".es($_SERVER['HTTP_USER_AGENT'])."'
		LIMIT 1
	");
	if(mysqli_num_rows($aa)){
		$_SESSION['user'] = mysqli_fetch_assoc($aa);
	} else {
		include './'.Core::$CONT.'./cab/logout.php';
	}
}



