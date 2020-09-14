<?php
if(isset($_POST['text']) && isset($_SESSION['user']['login'])) {
	if(mb_strlen($_POST['text']) < 2){
		$array = array(
			'status' => 'Комментарий должен быть чуть более развернутым'
		);
		echo json_encode($array);
		exit();
	} else {
		$date = date("Y-m-d H:i:s");
		q("
			INSERT INTO `reviews` SET
			`name` 	= '".es($_SESSION['user']['login'])."',
			`text` 	= '".es($_POST['text'])."',
			`date`	= '".$date."'
		");

		$array = array(
			'name' => hc($_SESSION['user']['login']),
			'text' => hc($_POST['text']),
			'date' => $date,
			'status' => 'ok'
		);
		echo json_encode($array);
		exit();
		}
}
$reviews = q("
	SELECT * FROM `reviews`
	ORDER BY `id` DESC
");

/*
$reviews = q("
	SELECT * FROM `reviews`
	WHERE `date` > '".es($_SESSION['date'])."'
	ORDER BY `id` DESC
");

$_SESSION['date'] = date("Y-m-d H:i:s");
 */