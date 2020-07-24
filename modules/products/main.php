<?php

if(isset($_POST['filter']) && isset($_POST['cat_ids'])) {
	$cat_ids = implode(',',intAll($_POST['cat_ids']));
	$products = q("
		SELECT *
		FROM `products`
		WHERE `cat_id` IN (".$cat_ids.")
		ORDER BY `category` ASC
	")or exit('ОШИБКА:'.mysqli_error($link));
} elseif(isset($_GET['id'])) {
	$products = q("
		SELECT *
		FROM `products`
		WHERE `id` = ".(int)$_GET['id']."
		LIMIT 1
	")or exit('ОШИБКА:'.mysqli_error($link));
} else {
	$products = q("
		SELECT *
		FROM `products`
		ORDER BY `category` ASC
	")or exit('ОШИБКА:'.mysqli_error($link));
}

$res = q("
	SELECT *
	FROM `products_cat`
") or exit('ОШИБКА:'.mysqli_error($link));