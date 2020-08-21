<?php

if(isset($_POST['add_author']) && !empty($_POST['new_author']) && !empty($_POST['about_auth'])) {
	$errors = array();
	if(mb_strlen($_POST['new_author']) < 2){
		$errors['author'] = 'Введите корректное имя';
	} elseif(mb_strlen($_POST['new_author']) > 42) {
		$errors['author'] = 'Используйте сокращенное имя автора';
	}
	if(!count($errors)) {
		$res = q("
			SELECT `id`
			FROM `authors`
			WHERE `name` = '".es($_POST['new_author'])."'
			LIMIT 1
		");
		if(mysqli_num_rows($res)) {
			$errors['author'] = 'Данный автор уже есть в списке авторов';
		}
		$res->close();
	}
	if(mb_strlen($_POST['about_auth']) < 45){
		$errors['author'] = 'Добавьте больше информации про автора';
	}

	if(!count($errors)) {
		q("
			INSERT INTO `authors` SET 
			`name` 			= '".es($_POST['new_author'])."',
			`description` 	= '".es(trim($_POST['about_auth']))."'
		");

		$_SESSION['info'] = 'Автор был успешно добавлен';
		header("Location: /admin/books/authormanager");
		exit();
	}
}

if(isset($_POST['new_books']) && isset($_POST['id']) && !empty($_POST['books'])) {
	for ($k = 0; $k < count($_POST['books']); $k++){
		$q = q("
			SELECT `id`
			FROM `books`
			WHERE `name` = '".es($_POST['books'][$k])."'
		");
		$row = $q->fetch_assoc();
		$books[] = $row['id'];
	}
	$q->close();

	$q = q("
		DELETE FROM `book2authors`
		WHERE `author_id` = ".(int)$_POST['id']."
	");
	$q->close();

	for($k = 0; $k < count($books); $k++){
		$q = q("
			INSERT INTO `book2authors` SET
			`author_id` 	= ".(int)$_POST['id'].",
			`book_id` 		= ".(int)$books[$k]."
		");
	}

	$booksids = implode(',',intAll($books));

	q("
		DELETE FROM `book2authors`
		WHERE `book_id`	NOT IN (".$booksids.")	
			AND `author_id`	= ".(int)$_POST['id']."
	");

	$_SESSION['info'] = 'Книги автора успешно изменены';
}

if(isset($_GET['id'])) {
	if(isset($_POST['delete']) && isset($_POST['auth_id'])) {
		q("
			DELETE FROM `authors`
			WHERE `id` = ".(int)$_POST['auth_id']."
			LIMIT 1
		");

		$_SESSION['info'] = 'Автор был удален';
		header("Location: /admin/books/authormanager");
		exit();
	}

	if(isset($_POST['rename']) && isset($_POST['id']) && !empty($_POST['new_name'])) {
		$errors = array();
		if(mb_strlen($_POST['new_name']) < 2){
			$errors['author'] = 'Введите корректное имя';
		} elseif(mb_strlen($_POST['new_name']) > 42) {
			$errors['author'] = 'Используйте сокращенное имя автора';
		}
		if(!count($errors)) {
			$res = q("
				SELECT `id`
				FROM `authors`
				WHERE `name` = '".es($_POST['new_name'])."'
					AND `id` !=	".(int)$_POST['id']."
				LIMIT 1
			");
			if(mysqli_num_rows($res)) {
				$errors['author'] = 'Автор <b>"'.hc($_POST['new_name']).'"</b> уже существует';
			}

			if(!count($errors)) {
				q("
					UPDATE `authors` SET
					`name` 		   = '".es(trimAll($_POST['new_name']))."'
					WHERE `id` 	   = ".(int)$_POST['id']."
					LIMIT 1
				");

				$_SESSION['info'] = 'Имя автора успешно изменено';
			}
			$res->close();
		}
	}
	if(isset($_POST['description']) && isset($_POST['id']) && !empty($_POST['new_descr'])) {
		$errors = array();

		if(mb_strlen($_POST['new_descr']) < 45){
			$errors['author'] = 'Добавьте больше информации про автора';
		}

		if(!count($errors)) {
			q("
				UPDATE `authors` SET
				`description`  = '".es(trim($_POST['new_descr']))."'
				WHERE `id` 	   = ".(int)$_POST['id']."
				LIMIT 1
			");

			$_SESSION['info'] = 'Описание автора успешно изменено';
		}
	}

	$author = q("
		SELECT *
		FROM `authors`
		WHERE `id` = ".(int)$_GET['id']." 
	");

	if(!mysqli_num_rows($author)) {
		$_SESSION['info'] = 'Данного автора не существует';
		header("Location: /admin/books/authormanager");
		exit();
	}

	$books2auth = q("
		SELECT `book_id`
		FROM `book2authors`
		WHERE `author_id` = ".(int)$_GET['id']."
	");
	while($row = $books2auth->fetch_assoc()) {
		$booksId[] = $row['book_id'];
	}
	$books2auth->close();

	if(!empty($booksId)) {
		for($k = 0; $k < count($booksId); $k++) {
			$q = q("
				SELECT `name`
				FROM `books`
				WHERE `id` = ".(int)$booksId[$k]."
			");
			$row = $q->fetch_assoc();
			$booksByAuthor[$k] = $row['name'];
		}
		$q->close();
	} else {
		$errors['book'] = 'Автору не присвоено ни одной книги из имеющихся';
	}
}

$authors = q("
	SELECT *
	FROM `authors`
");

$books = q("
	SELECT *
	FROM `books`
");

if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}
