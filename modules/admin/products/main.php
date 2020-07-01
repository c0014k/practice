<?php
if(isset($_POST['delete']) && isset($_POST['ids'])){
	foreach($_POST['ids'] as $k=>$v) {
		$_POST['ids'][$k] = (int)$v;
	}
	$ids = implode(',',$_POST['ids']);
	q("
		DELETE FROM `products`
		WHERE `id` IN (".$ids.")	
	") or exit(mysqli_error($link));

	$_SESSION['info'] = 'Выбранные продукты удалены';
	header("Location: /admin/products");
	exit();
}

if(isset($_GET['id'])){
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

if(isset($_SESSION['info'])){
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}