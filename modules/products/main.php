<?php

if(isset($_GET['num_page'])) {
	$limit = Pagination::howPages('products',3,$_GET['num_page']);
} else {
	$limit = Pagination::howPages('products',3,1);
}
$start = Pagination::$start;

if(isset($_GET['cat']) && !isset($_GET['id'])) {
	$products = q("
		SELECT *
		FROM `products`
		WHERE `cat_id` = ".(int)$_GET['cat']."
		ORDER BY `name` ASC
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
		LIMIT $start, $limit
	")or exit('ОШИБКА:'.mysqli_error($link));
}

$res = q("
	SELECT *
	FROM `products_cat`
") or exit('ОШИБКА:'.mysqli_error($link));
