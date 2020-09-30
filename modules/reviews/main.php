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
			'status' => 'Комментарий успешно добавлен'
		);
		echo json_encode($array);
		exit();
	}
}
if(isset($_POST['test'])) {
	$reviews = q("
		SELECT * FROM `reviews`
		WHERE `date` > '".es($_SESSION['date'])."'  
		LIMIT 1
	");
	$n = mysqli_num_rows($reviews);
	if($n !== 1){
		$array = array(
			'status' => 'not ok'
		);
		echo json_encode($array);
		exit();
	} else {
		$_SESSION['date'] = date("Y-m-d H:i:s");
		$row = mysqli_fetch_assoc($reviews);
		$array = array(
			'name' => hc($row['name']),
			'text' => nl2br(hc($row['text'])),
			'date' => $row['date'],
			'status' => 'ok'
		);
		echo json_encode($array);
		exit();
	}
}
$reviews = q("
	SELECT * FROM `reviews`
	ORDER BY `id` ASC 
");
/*
$latest_reviews = q("
	SELECT *
	FROM `review`
	WHERE `date` > NOW() - INTERVAL 1 MINUTE
");
WHERE `date` >= NOW() - INTERVAL 2 MINUTE AND `date` <= NOW() - INTERVAL 1 MINUTE
WHERE `date` BETWEEN NOW() - INTERVAL 2 MINUTE AND NOW() - INTERVAL 1 MINUTE
*/
