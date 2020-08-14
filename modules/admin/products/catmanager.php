<?php

if(isset($_POST['add_cat']) && !empty($_POST['new_cat'])) {
	$errors = array();
	if(mb_strlen($_POST['new_cat']) < 2) {
		$errors['cat'] = 'Название категории слишком короткое';
	} elseif(mb_strlen($_POST['new_cat']) > 25) {
		$errors['cat'] = 'Название категории слишком длинное';
	}

	if(!count($errors)) {
		$res = q("
			SELECT `id`
			FROM `products_cat`
			WHERE `name` = '".es($_POST['new_cat'])."'
			LIMIT 1
		");
		if(mysqli_num_rows($res)) {
			$errors['cat'] = 'Категория "'.hc($_POST['new_cat']).'" уже существует';
		} else {
			q("
				INSERT INTO `products_cat` SET 
				`name` = '".es($_POST['new_cat'])."'
			");
			$_SESSION['info'] = 'Категория была успешно добавлена';
		}
	}
}

if(isset($_POST['delete']) && isset($_POST['cat_id'])) {
	q("
		DELETE FROM `products_cat`
		WHERE `id` = ".(int)$_POST['cat_id']."
		LIMIT 1
	");

	q("
		UPDATE `products` SET
		`category` 	= 'undefined',
		`cat_id`	= '0'
		WHERE `cat_id` = ".(int)$_POST['cat_id']."
		LIMIT 1
	");

	$_SESSION['info'] = 'Категория удалены';
	header("Location: /admin/products/catmanager");
	exit();
}

if(isset($_POST['rename']) && isset($_POST['id']) && !empty($_POST['new_name'])) {
	$errors = array();
	if(mb_strlen($_POST['new_name']) < 2) {
		$errors['cat'] = 'Название категории слишком короткое';
	} elseif(mb_strlen($_POST['new_name']) > 25) {
		$errors['cat'] = 'Название категории слишком длинное';
	}
	if(!count($errors)) {
		$res = q("
			SELECT `id`
			FROM `products_cat`
			WHERE `name` = '".es($_POST['new_name'])."'
				AND `id` !=	".(int)$_POST['id']."
			LIMIT 1
		");
		if(mysqli_num_rows($res)) {
			$errors['cat'] = 'Категория "'.hc($_POST['new_name']).'" уже существует';
		} else {
			q("
				UPDATE `products_cat` SET
				`name` 		   = '".es(trimAll($_POST['new_name']))."'
				WHERE `id` 	   = ".(int)$_POST['id']."
				LIMIT 1
			");

			q("
				UPDATE `products` SET
				`category` 		   = '".es(trimAll($_POST['new_name']))."'
				WHERE `cat_id` 	   = ".(int)$_POST['id']."
				LIMIT 1
			");
			$_SESSION['info'] = 'Категория успешно переименована';
			header("Location: /admin/products/catmanager");
			exit();
		}
	}
}

$cats = q("
	SELECT *
	FROM `products_cat`
");

if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}