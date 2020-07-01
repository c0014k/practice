<?php
if(!isset($_POST['num1'],$_POST['num2'],$_POST['action'])) {
	$result = 'ВВЕДИТЕ ЗНАЧЕНИЯ';
} else {
	$result = calc($_POST['num1'], $_POST['num2'], $_POST['action']);
 }

function calc($num1,$num2,$action = '+') {
if($action == '-') {
	return ($num1 - $num2);
} elseif($action == '*') {
	return ($num1 * $num2);
} elseif($action == '+') {
	return ($num1 + $num2);
} elseif($action == '/') {
	if($num2 == 0) {
		return "Эта операция недопустима";
		} else {
			return ($num1 / $num2);
		}
	}
}