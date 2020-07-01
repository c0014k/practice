<?php

$category = array('Холодильники','Телевизоры','Ноутбуки',);
if(isset($_POST['add'],$_POST['availability'])) {
	if(in_array($_POST['category'], $category) && !empty($_POST['price'] && $_POST['description'] && $_POST['name'] && $_POST['category'] && $_POST['code'])) {
		if($_FILES['file']['error'] == 0) {
			if(Uploader::upload($_FILES['file'])) {
				Uploader::resize(300, 400, '300x400');
				Uploader::resize(100, 100, '100x100');
				$filename = Uploader::$filename;
				q("
					INSERT INTO `products` SET
					`category` 	  	= '".es($_POST['category'])."',
					`code` 	  		= ".(int)$_POST['code'].",
					`availability`	= ".(int)$_POST['availability'].",
					`name` 		  	= '".es(trim($_POST['name']))."',
					`description` 	= '".es(trim($_POST['description']))."',
					`price` 	  	= ".(float)$_POST['price'].",
					`img`		   = '".$filename."'
				") or exit('ОШИБКА:'.mysqli_error($link));

				$_SESSION['info'] = 'Запись была добавлена';
				header("Location: /admin/products");
				exit();
			} else {
				$errors['photo'] = Uploader::$error;
			}
		} else {
			$errors['photo'] = 'Вы не выбрали изображение';
		}
	}
}