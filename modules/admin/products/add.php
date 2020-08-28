<?php

if(isset($_POST['add'],$_POST['availability'])) {
	if(!empty($_POST['category'] && $_POST['price'] && $_POST['description'] && $_POST['name'] && $_POST['category'] && $_POST['code'])) {
		$prod_cat = q("
			SELECT `id`
			FROM `products_cat`
			WHERE `name` = '".es($_POST['category'])."'
		");

		$prod_cat_row = $prod_cat->fetch_assoc();

		if($_FILES['file']['error'] == 0) {
			if(Uploader::upload($_FILES['file'])) {
				Uploader::resize(300, 400, '300x400');
				Uploader::resize(100, 100, '100x100');
				$filename = Uploader::$filename;

				$errors = array();
				if(mb_strlen($_POST['name']) < 2){
					$errors['prod'] = 'Название товара слишком короткое';
				} elseif(mb_strlen($_POST['name']) > 42) {
					$errors['prod'] = 'Название товара слишком длинное';
				}
				if(!count($errors)) {
					$res = q("
						SELECT `id`
						FROM `products`
						WHERE `name` = '".es($_POST['name'])."'
						LIMIT 1
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
						INSERT INTO `products` SET
						`category` 	  	= '".es($_POST['category'])."',
						`code` 	  		= ".(int)$_POST['code'].",
						`availability`	= ".(int)$_POST['availability'].",
						`name` 		  	= '".es(trim($_POST['name']))."',
						`description` 	= '".es(trim($_POST['description']))."',
						`price` 	  	= ".(float)$_POST['price'].",
						`img`		  	= '".$filename."',
						`cat_id`		= ".(int)$prod_cat_row['id']."
					");

					$_SESSION['info'] = 'Запись была добавлена';
					header("Location: /admin/products");
					exit();
				}
			} else {
				$errors['photo'] = Uploader::$error;
			}
		} else {
			$errors['photo'] = 'Вы не выбрали изображение';
		}
	}
}
$res = q("
	SELECT *
	FROM `products_cat`
");
