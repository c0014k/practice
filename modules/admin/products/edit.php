<?php

if(isset($_POST['edit'],$_POST['availability'])) {
	if(!empty($_POST['price'] && $_POST['description'] && $_POST['name'] && $_POST['code'] && $_POST['category'])) {
		q( "
			UPDATE `products` SET
			`category` 	   	= '".es($_POST['category'])."',
			`code`		   	= ".(int)$_POST['code'].",
			`availability` 	= ".(int)$_POST['availability'].",
			`name` 		  	= '".es(trimAll($_POST['name']))."',
			`description` 	= '".es(trimAll($_POST['description']))."',
			`price`       	= ".(float)$_POST['price']."
			WHERE `id` 	   	= ".(int)$_GET['id']."
		");

		$cat_id = q("
			SELECT *
			FROM `products_cat`
			WHERE `name` 	= '".es($_POST['category'])."'
			LIMIT 1
		");
		$cat_id = $cat_id->fetch_assoc();

		q( "
			UPDATE `products` SET
			`cat_id`		= ".(int)$cat_id['id']."		
			WHERE `id` 	   	= ".(int)$_GET['id']."
		");

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
		");

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
");

if(!mysqli_num_rows($products)) {
	$_SESSION['info'] = 'Данного продукта не существует';
	header("Location: /admin/products");
	exit();
}
$row = $products->fetch_assoc();

$res = q("
	SELECT *
	FROM `products_cat`
");