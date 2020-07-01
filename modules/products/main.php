<?php

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