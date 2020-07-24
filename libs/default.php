<?php

function wtf($array, $stop = false) {
	echo '<pre>'.print_r($array,1).'</pre>';
	if(!$stop) {
		exit();
	}
}

class DB {
	static public $mysqli = array();
	static public $connect = array();

	static public function _($key = 0) {
		if(!isset(self::$mysqli[$key])) {
			if(!isset(self::$connect['server']))
				self::$connect['server'] = Core::$DB_LOCAL;
			if(!isset(self::$connect['user']))
				self::$connect['user'] = Core::$DB_LOGIN;
			if(!isset(self::$connect['pass']))
				self::$connect['pass'] = Core::$DB_PASS;
			if(!isset(self::$connect['db']))
				self::$connect['db'] = Core::$DB_NAME;

			self::$mysqli[$key] = @new mysqli(self::$connect['server'],self::$connect['user'],self::$connect['pass'],self::$connect['db']); // WARNING
			if (mysqli_connect_errno()) {
				echo 'Не удалось подключиться к Базе Данных';
				exit;
			}
			if(!self::$mysqli[$key]->set_charset("utf8")) {
				echo 'Ошибка при загрузке набора символов utf8:'.self::$mysqli[$key]->error;
				exit;
			}
		}
		return self::$mysqli[$key];
	}
	static public function close($key = 0) {
		self::$mysqli[$key]->close();
		unset(self::$mysqli[$key]);
	}
}

function q($query,$key = 0) {
	$res = DB::_($key)->query($query);
	if($res === false) {
		$info = debug_backtrace();
		$error = "QUERY: ".$query."<br>\n".DB::_($key)->error."<br>\n".
			"file: ".$info[0]['file']."<br>\n".
			"line: ".$info[0]['line']."<br>\n".
			"date: ".date("Y-m-d H:i:s")."<br>\n".
			"===================================";

		file_put_contents('./logs/mysql.log',strip_tags($error)."\n\n",FILE_APPEND);
		echo $error;
		exit();
	}
	return $res;
}

function es($el,$key = 0) {
	return DB::_($key)->real_escape_string($el);
}

function hc($el) {
	if (!is_array($el)) {
		$el = htmlspecialchars($el);
	} else {
		$el = array_map('hc',$el);
	}
	return $el;
}

function trimAll($el) {
	if (!is_array($el)) {
		$el = trim($el);
	} else {
		$el = array_map('trimAll',$el);
	}
	return $el;
}

function intAll($el) {
	if (!is_array($el)) {
		$el = (int)$el;
	} else {
		$el = array_map('intAll',$el);
	}
	return $el;
}

function floatAll($el) {
	if (!is_array($el)) {
		$el = (float)$el;
	} else {
		$el = array_map('floatAll',$el);
	}
	return $el;
}

function myHash($var) {
	$salt = '2cJ';
	$salt2 = 'iDw7';
	$var = crypt(md5($var.$salt),$salt2);
	return $var;
}

spl_autoload_register(function($class) {
	include './libs/class_'.$class.'.php';
});
