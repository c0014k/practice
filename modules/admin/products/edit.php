<?php

if(isset($_POST['edit'],$_POST['availability'])) {
	if(!empty($_POST['price'] && $_POST['description'] && $_POST['name'] && $_POST['code'] && $_POST['category'])) {
		q( "
			UPDATE `products` SET
			`category` 	   = '".es($_POST['category'])."',
			`code`		   = ".(int)$_POST['code'].",
			`availability` = ".(int)$_POST['availability'].",
			`name` 		   = '".es(trimAll($_POST['name']))."',
			`description`  = '".es(trimAll($_POST['description']))."',
			`price`        = ".(float)$_POST['price']."
			WHERE `id` 	   = ".(int)$_GET['id']."
		") or exit('ОШИБКА:'.mysqli_error($link));

		$_SESSION['info'] = 'Запись была изменена';
		header("Location: /admin/products");
		exit();
	}
}
if(isset($_POST['editimg'])) {
	if(Uploader::upload($_FILES['file'])) {
		Uploader::resize(300, 400, '300x400');
		Uploader::resize(100, 100, '100x100');
		$filename = Uploader::$filename;
		q("
			UPDATE `products` SET
			`img`		= '".$filename."'
			WHERE `id`	= ".(int)$_GET['id']."
		") or exit('ОШИБКА:'.mysqli_error($link));

		$_SESSION['info'] = 'Запись была изменена';
		header("Location: /admin/products/edit?id=".(int)$_GET['id']."");
		exit();
	} else {
		$errors['photo'] = Uploader::$error;
	}
}

$products = q("
	SELECT *
	FROM `products`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
") or exit(mysqli_error($link));

if(!mysqli_num_rows($products)) {
	$_SESSION['info'] = 'Данного продукта не существует';
	header("Location: /admin/products");
	exit();
}
$row = mysqli_fetch_assoc($products);
