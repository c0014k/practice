<?php

if(isset($_GET['id'])) {
	$checkId = q("
		SELECT *
		FROM `products`
		WHERE `id` = ".(int)$_GET['id']."
		LIMIT 1
	");

	if(!mysqli_num_rows($checkId)) {
		$_SESSION['info'] = 'Данного продукта не существует';
		header("Location: /admin/products");
		exit();
	}


	if(isset($_POST['edit'],$_POST['availability'])) {
		if(!empty($_POST['price'] && $_POST['description'] && $_POST['name'] && $_POST['code'] && $_POST['category'])) {

			$errors = array();
			if(mb_strlen($_POST['name']) < 2){
				$errors['prod'] = 'Название товара слишком короткое';
			} elseif(mb_strlen($_POST['name']) > 42) {
				$errors['prod'] = 'Название товара слишком длинное';
			}
			if(!count($errors)) {
				$res = q("
							SELECT *
							FROM `products`
							WHERE `name` = '".es($_POST['name'])."'
								AND `id` != ".(int)$_GET['id']."
						");
				if(mysqli_num_rows($res)) {
					$errors['prod'] = 'Товар с таким именем уже существует';
				}
			}
			if(mb_strlen($_POST['description']) < 5){
				$errors['prod'] = 'Описание товара слишком короткое';
			}

			if(!count($errors)) {
				q("
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

				q("
					UPDATE `products` SET
					`cat_id`		= ".(int)$cat_id['id']."		
					WHERE `id` 	   	= ".(int)$_GET['id']."
				");

				$_SESSION['info'] = 'Запись была изменена';
				header("Location: /admin/products");
				exit();
			}
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

	$row = $products->fetch_assoc();
	$products->close();

} else {
	$_SESSION['info'] = 'Данного товара не существует';
	header("Location: /admin/products");
	exit();
}

$res = q("
	SELECT *
	FROM `products_cat`
");

