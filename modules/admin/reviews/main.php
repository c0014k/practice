<?php

if(isset($_GET['id'])) {
	q("
		DELETE FROM `reviews`
		WHERE `id` = ".(int)$_GET['id']."	
		LIMIT 1
	") or exit(mysqli_error($link));

	$_SESSION['info'] = 'Отзыв успешно удален';
	header("Location: /reviews");
	exit();
}




