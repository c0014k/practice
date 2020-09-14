<?php

if(isset($_GET['id'])) {
	q("
		DELETE FROM `reviews`
		WHERE `id` = ".(int)$_GET['id']."	
		LIMIT 1
	");

	$_SESSION['info'] = 'Комментарий успешно удален';
	header("Location: /reviews");
	exit();
}




