<?php
if(!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) {
	if($_GET['module'] != 'static' || $_GET['page'] != 'main') {
		header ("Location: /admin/static/main");
		exit();
	}
}
if(in_array("127.0.0.1",$iparray) || in_array("192.168.1.108",$iparray)) {
	phpinfo();
} else {
	echo '<h1>'.'В доступе отказано'.'</h1>';
}
