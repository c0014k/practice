<?php

function wtf($array, $stop = false) {
	echo '<pre>'.print_r($array,1).'</pre>';
	if(!$stop) {
		exit();
	}
}

function q($query) {
	global $link;
	$res = mysqli_query($link,$query);
	if($res === false) {
		$info = debug_backtrace();
		$error = "<b>Дата: 	 </b>".date("Y.m.d, <b>Время:</b> H:i a")."<br>\n".
			 	 "<b>Запрос: </b>".hc($query)."<br>\n".
				 '<b>Файл:	 </b>'.$info[0]['file']."<br>\n".
				 '<b>Строка: </b>'.$info[0]['line']."<br>\n".
				 '<b>Ошибка: </b>'.mysqli_error($link);
		// Добавить отправку уведомления на почту
		file_put_contents('./logs/mysql.log',htmlspecialchars_decode(strip_tags($error))."\n\n", FILE_APPEND);
		echo $error;
		exit();
	} else {
		return $res;
	}
}

function es($el) {
	global $link;
	if (!is_array($el)) {
		$el = mysqli_real_escape_string($link,$el);
	} else {
		$el = array_map('es',$el);
	}
	return $el;
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
