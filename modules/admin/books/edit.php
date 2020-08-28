<?php

if(isset($_GET['id'])) {

	$checkId = q("
		SELECT *
		FROM `books`
		WHERE `id` = ".(int)$_GET['id']."
		LIMIT 1
	");

	if(!mysqli_num_rows($checkId)) {
		$_SESSION['info'] = 'Данной книги не существует';
		header("Location: /admin/books");
		exit();
	}

	if(isset($_POST['edit'],$_POST['availability']) && !empty($_POST['price'] && $_POST['description'] && $_POST['name'] && $_POST['code'])) {

		q( "
			UPDATE `books` SET
			`code`		   = ".(int)$_POST['code'].",
			`availability` = ".(int)$_POST['availability'].",
			`name` 		   = '".es(trim($_POST['name']))."',
			`description`  = '".es(trim($_POST['description']))."',
			`price`        = ".(float)$_POST['price']."
			WHERE `id` 	   = ".(int)$_GET['id']."
		");

		if(isset($_POST['authors'])) {
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

			q("
				DELETE
				FROM `book2authors`
				WHERE `book_id` = ".(int)$_GET['id']."
			");

			for($i = 0; $i < $numberOfAuthors; $i++){
				$row = $res->fetch_assoc();
				q("
					INSERT INTO `book2authors` SET
					`book_id` 	  	= ".(int)$_GET['id'].",
					`author_id`		= ".(int)$row['id']."
				");
			}
			$res->close();
		}

		$_SESSION['info'] = 'Запись была изменена';
		header("Location: /admin/books");
		exit();
	}

	if(isset($_POST['editimg'])) {
		if(Uploader::upload($_FILES['file'])) {
			Uploader::resize(300, 400, '300x400');
			Uploader::resize(100, 100, '100x100');
			$filename = Uploader::$filename;
			q("
				UPDATE `books` SET
				`img`		= '".$filename."'
				WHERE `id`	= ".(int)$_GET['id']."
			");

			$_SESSION['info'] = 'Запись была изменена';
			header("Location: /admin/books/edit?id=".(int)$_GET['id']."");
			exit();
		} else {
			$errors['photo'] = Uploader::$error;
		}
	}

	$res = q("
		SELECT `author_id`
		FROM `book2authors`
		WHERE `book_id` = ".(int)$_GET['id']."
	");

	while($row = $res->fetch_assoc()) {
		$res2 = q("
			SELECT `name`
			FROM `authors`
			WHERE `id` = ".$row['author_id']."
		");

		$author = $res2->fetch_assoc();
		$authors[] = $author['name'];
	}
	$res->close();
	$res2->close();

	$book = q("
		SELECT *
		FROM `books`
		WHERE `id` = ".(int)$_GET['id']."
		LIMIT 1
	");

	$row = $book->fetch_assoc();
	$book->close();
} else {
	$_SESSION['info'] = 'Данной книги не существует';
	header("Location: /admin/books");
	exit();
}

$res = q("
	SELECT *
	FROM `authors`
");
