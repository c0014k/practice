<?php
if(isset($_POST['delete']) && isset($_POST['ids'])) {
	$ids = implode(',',intAll($_POST['ids']));
	q("
		DELETE FROM `books`
		WHERE `id` IN (".$ids.")	
	");

	$_SESSION['info'] = 'Выбранные продукты удалены';
	header("Location: /admin/books");
	exit();
}

if(isset($_GET['book'])) {
	$books = q("
		SELECT *  
		FROM `books`
		WHERE `name` = '".es($_GET['book'])."'
		LIMIT 1
	");

	if(!mysqli_num_rows($books)) {
		$_SESSION['info'] = 'Данной книги не существует';
		header("Location: /admin/books");
		exit();
	}

	$res = q("
		SELECT authors.name
		FROM authors
		JOIN book2authors ON authors.id = book2authors.author_id
		JOIN books ON book2authors.book_id = books.id
		WHERE books.name = '".es($_GET['book'])."'
	");

	while($row = $res->fetch_assoc()) {
		$authors[] = $row['name'];
	}
	$res->close();
	$numberOfAuthors = count($authors);
} else {
	$books = q("
		SELECT *
		FROM `books`
		ORDER BY `id` ASC
	");
}

if(isset($_GET['author'])) {
	$res = q("
		SELECT *
		FROM `authors`
		WHERE `name` = '".es($_GET['author'])."'
		LIMIT 1
	");

	if(!mysqli_num_rows($res)) {
		$_SESSION['info'] = 'Данной автора не существует';
		header("Location: /admin/books");
		exit();
	}

	$row = $res->fetch_assoc();
	$about_author = $row['description'];
	$res->close();

	$res = q("
		SELECT books.name
		FROM books
		JOIN book2authors ON books.id = book2authors.book_id
		JOIN authors ON book2authors.author_id = authors.id
		WHERE authors.name = '".es($_GET['author'])."'
	");

	while($row2 = $res->fetch_assoc()) {
		$author_books[] = $row2['name'];
	}
	$numberOfBooks = count($author_books);
	$res->close();
}
if(isset($_SESSION['info'])){
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}