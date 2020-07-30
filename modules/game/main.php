<?php
if(!isset($_SESSION['server'],$_SESSION['client'])) {
	$_SESSION['server'] = 10;
	$_SESSION['client'] = 10;
}
if(isset($_POST['x'])) {
$point = array(1,2,3,);/*[1, 2, 3];*/
	if(in_array(($_POST['x']), $point)) {
		if($_POST['x'] == rand(1, 3)) {
			$_SESSION['client'] -= rand(1, 4);
		} else {
			$_SESSION['server'] -= rand(1, 4);
		}
	} else {
		$znach = 'Вы ввели неверное значение';
	}
}
if (($_SESSION['client'] <= 0) || ($_SESSION['server'] <= 0)) {
	header("Location:/game/gameover");
} else {
	$stat = 'ХП Сервера = '.$_SESSION['server'].'<br>'.'ХП Клиента = '.$_SESSION['client'];
}