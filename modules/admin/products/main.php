<?php

if(isset($_POST['delete']) && isset($_POST['ids'])) {
	$ids = implode(',',intAll($_POST['ids']));
	q("
		DELETE FROM `products`
		WHERE `id` IN (".$ids.")	
	");

	$_SESSION['info'] = 'Выбранные продукты удалены';
	header("Location: /admin/products");
	exit();
}

if(isset($_POST['filter']) && isset($_POST['cat_ids'])) {
	$cat_ids = implode(',',intAll($_POST['cat_ids']));
	$products = q("
		SELECT *
		FROM `products`
		WHERE `cat_id` IN (".$cat_ids.")
		ORDER BY `category` ASC
	");
} elseif(isset($_GET['id'])) {
	$products = q("
		SELECT *
		FROM `products`
		WHERE `id` = ".(int)$_GET['id']."
		LIMIT 1
	");
} else {
	$products = q("
		SELECT *
		FROM `products`
		ORDER BY `category` ASC
	");
}

$res = q("
	SELECT *
	FROM `products_cat`
");

if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}