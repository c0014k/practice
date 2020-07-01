<?php
if(isset($_POST['text']) && isset($_GET['id'])) {
	q("
		UPDATE `reviews` SET
		`text` 		= '".es(trimAll($_POST['text']))."'
		WHERE `id` 	= ".(int)$_GET['id']."
	") or exit('ОШИБКА:'.mysqli_error($link));

	$_SESSION['info'] = 'Запись была изменена';
	header("Location: /reviews");
	exit();
}
$reviews = q("
	SELECT `text`
	FROM `reviews`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
") or exit(mysqli_error($link));
if(!mysqli_num_rows($reviews)) {
	$_SESSION['info'] = 'Данный отзыв отсутствует';
	header("Location: /reviews");
	exit();
}
$row = mysqli_fetch_assoc($reviews);