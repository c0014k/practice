<?php
if(isset($_SESSION['user'])) {
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
}
if(($_GET['module'] != 'static' || $_GET['page'] != 'main') && !isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	header ("Location: /index.php");
	exit();
}

