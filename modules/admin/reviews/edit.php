<?php
if(isset($_POST['text']) && isset($_GET['id'])) {
	q("
		UPDATE `reviews` SET
		`text` 		= '".es(trimAll($_POST['text']))."'
		WHERE `id` 	= ".(int)$_GET['id']."
	");

	$_SESSION['info'] = 'Запись была изменена';
	header("Location: /reviews");
	exit();
}
$reviews = q("
	SELECT `text`
	FROM `reviews`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
");

if(!mysqli_num_rows($reviews)) {
	$_SESSION['info'] = 'Данный комментарий отсутствует';
	header("Location: /reviews");
	exit();
}
$row = mysqli_fetch_assoc($reviews);