<?php

class DB{
	static public $mysqli = array();
	static public $connect = array();

	static public function _($key = 0){
		if (!isset(self::$mysqli[$key])) {
			if(!isset(self::$connect['server']))
				self::$connect['server'] = Core::$DB_LOCAL;
			if(!isset(self::$connect['user']))
				self::$connect['user'] = Core::$DB_LOGIN;
			if(!isset(self::$connect['pass']))
				self::$connect['pass'] = Core::$DB_PASS;
			if(!isset(self::$connect['db']))
				self::$connect['db'] = Core::$DB_NAME;
			self::$mysqli[$key] = @new mysqli(self::$connect['server'],self::$connect['user'],self::$connect['pass'],self::$connect['db']);
			if(mysqli_connect_errno()) {
				echo 'Не удалось подключиться к Базе Данных';
				exit();
			}
			if(!self::$mysqli[$key]->set_charset("utf-8")) {
				echo 'Ошибка при загрузке набора символов utf-8:'.self::$mysqli[$key]->error;
				exit();
			}
		}
		return self::$mysqli[$key];
	}

	static public function close($key = 0) {
		self::$mysqli[$key]->close();
		unset(self::$mysqli[$key]);
	}
}

DB::_()->query();


