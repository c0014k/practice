<?php
if (isset($_GET['link'])) {
	$x = scandir($_GET['link']);
} else {
	$x = scandir('.');
}
/*
$dir = ($_GET['link'] ? './'.$_GET['link'] : '.');
$x = scandir($dir);
*/