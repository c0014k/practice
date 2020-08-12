<?php

if(isset($_POST['edit'],$_POST['availability']) && !empty($_POST['price'] && $_POST['description'] && $_POST['name'] && $_POST['code'])) {
	q( "
		UPDATE `books` SET
		`code`		   = ".(int)$_POST['code'].",
		`availability` = ".(int)$_POST['availability'].",
		`name` 		   = '".es(trimAll($_POST['name']))."',
		`description`  = '".es(trimAll($_POST['description']))."',
		`price`        = ".(float)$_POST['price']."
		WHERE `id` 	   = ".(int)$_GET['id']."
	");

	$_SESSION['info'] = 'Запись была изменена';
	header("Location: /admin/books");
	exit();
}

if(isset($_POST['editimg'])) {
	if(Uploader::upload($_FILES['file'])) {
		Uploader::resize(300, 400, '300x400');
		Uploader::resize(100, 100, '100x100');
		$filename = Uploader::$filename;
		q("
			UPDATE `books` SET
			`img`		= '".$filename."'
			WHERE `id`	= ".(int)$_GET['id']."
		");

		$_SESSION['info'] = 'Запись была изменена';
		header("Location: /admin/books/edit?id=".(int)$_GET['id']."");
		exit();
	} else {
		$errors['photo'] = Uploader::$error;
	}
}

$books = q("
	SELECT *
	FROM `books`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
");

if(!mysqli_num_rows($books)) {
	$_SESSION['info'] = 'Данного продукта не существует';
	header("Location: /admin/books");
	exit();
}
$row = $books->fetch_assoc();
