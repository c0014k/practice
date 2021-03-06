<?php

if(isset($_POST['add'],$_POST['availability'],$_POST['authors']) && !empty($_POST['code'] && $_POST['name'] && $_POST['description'] && $_POST['price'])) {
	$numberOfAuthors = count($_POST['authors']);
	for($i = 0; $i < $numberOfAuthors; $i++) {
		$authorsMass[$i] = es($_POST['authors'][$i]);
	}

	$authors2 = '';
	for($i = 0; $i < $numberOfAuthors; $i++) {
		$authors2 .= "'$authorsMass[$i]',";
	}
	$authorsString = substr($authors2,0,-1);

	$res = q("
		SELECT *
		FROM `authors`
		WHERE `name` IN (".$authorsString.")
	");


	if($_FILES['file']['error'] == 0) {
		if(Uploader::upload($_FILES['file'])) {
			Uploader::resize(300, 400, '300x400');
			Uploader::resize(100, 100, '100x100');
			$filename = Uploader::$filename;
			q("
				INSERT INTO `books` SET
				`code` 	  		= ".(int)$_POST['code'].",
				`availability`	= ".(int)$_POST['availability'].",
				`name` 		  	= '".es(trim($_POST['name']))."',
				`description` 	= '".es(trim($_POST['description']))."',
				`price` 	  	= ".(float)$_POST['price'].",
				`img`		  	= '".$filename."'
			");

			$res2 = q("
				SELECT *
				FROM `books`
				WHERE `name` = '".es(trim($_POST['name']))."'
					AND `code` = ".(int)$_POST['code']."
				LIMIT 1
			");
			$row2 = $res2->fetch_assoc();
			$res2->close();

			for($i = 0; $i < $numberOfAuthors; $i++){
				$row = $res->fetch_assoc();
				q("
					INSERT INTO `book2authors` SET
					`book_id` 	  	= ".(int)$row2['id'].",
					`author_id`		= ".(int)$row['id']."
				");
			}
			$res->close();

			$_SESSION['info'] = 'Запись была добавлена';
			header("Location: /admin/books");
			exit();
		} else {
			$errors['photo'] = Uploader::$error;
		}
	} else {
		$errors['photo'] = 'Вы не выбрали изображение';
	}
}

$res = q("
	SELECT *
	FROM `authors`
");
