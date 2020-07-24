<?php

if(isset($_GET['route'])) {
	$temp = explode('/',$_GET['route']);

	if($temp[0] == 'admin') {
		Core::$CONT = Core::$CONT.'/admin';
		Core::$SKIN = 'admin';
		unset($temp[0]);
	}

	$i = 0;
	foreach($temp as $k=>$v) {
		if($i == 0) {
			$_GET['module'] = $v;
		} elseif($i == 1) {
			if(!empty($v)) {
				$_GET['page'] = $v;
			}
		} else {
			$_GET['key'.($k-1)] = $v;
		}
 		++$i;
	}
	unset($_GET['route']);
}

if(!isset($_GET['module'])) {
	$_GET['module'] = 'static';
} elseif (Core::$SKIN != 'admin') {
	$res = q("
		SELECT *
		FROM `pages`
		WHERE `module` = '".es($_GET['module'])."'
		LIMIT 1
	");
	if(!$res->num_rows) {
		header("Location: /404");
		exit();
	} else {
		$staticpage = $res->fetch_assoc();
		$res->close();
		if($staticpage['static'] == 1) {
			$_GET['module'] = 'staticpage';
			$_GET['page'] = 'main';
		}
	}
}

if(!isset($_GET['page'])) {
	$_GET['page'] = 'main';
}

if(!preg_match('#^[a-z-_]*$#iu',$_GET['page'])) {
	header("Location: /404");
	exit();
}

