<?php
if(isset($_POST['delete']) && isset($_POST['ids'])) {
	$ids = implode(',',intAll($_POST['ids']));
	q("
		DELETE FROM `books`
		WHERE `id` IN (".$ids.")	
	") or exit(mysqli_error($link));

	$_SESSION['info'] = 'Выбранные продукты удалены';
	header("Location: /admin/books");
	exit();
}

if(isset($_GET['book'])) {
	$books = q("
		SELECT *  
		FROM `books`
		WHERE `name` = '".hc($_GET['book'])."'
		LIMIT 1
	")or exit('ОШИБКА:'.mysqli_error($link));

	$res = q("
		SELECT authors.name
		FROM authors
		JOIN book2authors ON authors.id = book2authors.author_id
		JOIN books ON book2authors.book_id = books.id
		WHERE books.name = '".hc($_GET['book'])."'
	") or exit('ОШИБКА:'.mysqli_error($link));

	while($row = $res->fetch_assoc()) {
		$authors[] = $row['name'];
	}
	$res->close();
	$n = count($authors);
} else {
	$books = q("
		SELECT *
		FROM `books`
		ORDER BY `id` ASC
	")or exit('ОШИБКА:'.mysqli_error($link));
}

if(isset($_GET['author'])) {
	$res = q("
		SELECT *
		FROM `authors`
		WHERE `name` = '".hc($_GET['author'])."'
		LIMIT 1
	")or exit('ОШИБКА:'.mysqli_error($link));

	$row = $res->fetch_assoc();
	$about_author = $row['description'];
	$res->close();

	$res = q("
		SELECT books.name
		FROM books
		JOIN book2authors ON books.id = book2authors.book_id
		JOIN authors ON book2authors.author_id = authors.id
		WHERE authors.name = '".hc($_GET['author'])."'
	") or exit('ОШИБКА:'.mysqli_error($link));

	while($row = $res->fetch_assoc()) {
		$author_books[] = $row['name'];
	}
	$m = count($author_books);
	$res->close();
}
if(isset($_SESSION['info'])){
	$info = $_SESSION['info'];
	unset($_SESSION['info']);
}