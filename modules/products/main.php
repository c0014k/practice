<?php

if(isset($_GET['num_page'])) {
	$limit = Pagination::howPages('products',3,$_GET['num_page']);
} else {
	$limit = Pagination::howPages('products',3,1);
}
$start = Pagination::$start;

if(isset($_GET['cat']) && !isset($_GET['name'])) {
	$products = q("
		SELECT *
		FROM `products`
		WHERE `category` = '".es($_GET['cat'])."'
		ORDER BY `name` ASC
	");

	if(!mysqli_num_rows($products)) {
		header("Location: /products");
		exit();
	}
} elseif(isset($_GET['name'])) {
	$products = q("
		SELECT *
		FROM `products`
		WHERE `name` = '".es($_GET['name'])."'
		LIMIT 1
	");

	if(!mysqli_num_rows($products)) {
		header("Location: /products");
		exit();
	}
} else {
	$products = q("
		SELECT *
		FROM `products`
		ORDER BY `category` ASC
		LIMIT $start, $limit
	");
}

$res = q("
	SELECT *
	FROM `products_cat`
");
