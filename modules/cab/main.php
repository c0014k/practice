<?php
if (!isset($_SESSION['user'])){
	header ("Location: /cab/auth");
	exit();
} else {
	header("Location: /cab/user");
}