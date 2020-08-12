<?php
if(isset($_GET['num_page'])) {
	$limit = Pagination::howPages('books',2,$_GET['num_page']);
} else {
	$limit = Pagination::howPages('books',2,1);
}
$start = Pagination::$start;

if(isset($_GET['book'])) {
	$books = q("
		SELECT *  
		FROM `books`
		WHERE `name` = '".es($_GET['book'])."'
		LIMIT 1
	");

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
		LIMIT $start, $limit
	");
}

if(isset($_GET['author'])) {
	$res = q("
		SELECT *
		FROM `authors`
		WHERE `name` = '".es($_GET['author'])."'
		LIMIT 1
	");

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

	while($row = $res->fetch_assoc()) {
		$author_books[] = $row['name'];
	}
	$numberOfBooks = count($author_books);
	$res->close();
}
