<?php

if(isset($_POST['add_cat']) && !empty($_POST['new_cat'])) {
	q("
		INSERT INTO `products_cat` SET 
		`name` = '".es($_POST['new_cat'])."'
	");

	$_SESSION['info'] = 'Категория была успешно добавлена';
	if(isset($_SESSION['info'])) {
		$info = $_SESSION['info'];
		unset($_SESSION['info']);
	}
}

if(isset($_POST['delete']) && isset($_POST['cat_ids'])) {
	$ids = implode(',',intAll($_POST['cat_ids']));
	q("
		DELETE FROM `products_cat`
		WHERE `id` IN (".$ids.")	
	");

	q("
		UPDATE `products` SET
		`category` 	= 'undefined',
		`cat_id`	= '0'
		WHERE `cat_id` IN (".$ids.")
	");

	$_SESSION['info'] = 'Выбранные категории удалены';
	header("Location: /admin/products/catmanager");
	exit();
}

if(isset($_POST['rename']) && isset($_POST['id']) && !empty($_POST['new_name'])) {
	q("
		UPDATE `products_cat` SET
		`name` 		   = '".es(trimAll($_POST['new_name']))."'
		WHERE `id` 	   = ".(int)$_POST['id']."
	");

	q("
		UPDATE `products` SET
		`category` 		   = '".es(trimAll($_POST['new_name']))."'
		WHERE `cat_id` 	   = ".(int)$_POST['id']."
	");

	$_SESSION['info'] = 'Категория успешно переименована';
	header("Location: /admin/products/catmanager");
	exit();
}

$cats = q("
	SELECT *
	FROM `products_cat`
");

if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}