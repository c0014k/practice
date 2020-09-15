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
	ORDER BY `id` DESC
");
	while ($row = mysqli_fetch_assoc($reviews)) {
		$array2 = array(
			'name' => hc($row['name']),
			'text' => nl2br(hc($row['text'])),
			'date' => $row['date']
		);
		echo json_encode($array2);
	}
	$_SESSION['date'] = date("Y-m-d H:i:s");
	exit();
}


$reviews = q("
	SELECT * FROM `reviews`
	ORDER BY `id` DESC
");
