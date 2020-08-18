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
			header("Location: /admin/books/authormanager");
			exit();
		}
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
		header("Location: /admin/books/authormanager");
		exit();
	}
}
/*
if(isset($_POST['new_books']) && isset($_POST['id']) && !empty($_POST['id'])) {
	$res2 = q("
		SELECT `book_id`
		FROM `book2authors`
		WHERE `author_id` = ".(int)$_POST['id']."
	");

	while($row = $res2->fetch_assoc()) {
		$res3 = q("
		SELECT `name`
		FROM `books`
		WHERE `id` = ".$row['book_id']."
	");
		$book = $res3->fetch_assoc();
		$book[] = $book['name'];
		wtf($book);
	}
	$res2->close();
	$res3->close();
}
*/

$authors = q("
	SELECT *
	FROM `authors`
");

$books = q("
	SELECT `name`
	FROM `books`
");

if(isset($_SESSION['info'])) {
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}