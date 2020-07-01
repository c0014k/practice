<?php
class Mail {
	static $subject		= 'use defaults';
	static $from		= 'admin@mail.com';
	static $to			= 'user@mail.com';
	static $text 		= 'Template text';
	static $headers 	= '';

	static function testMail(){
		if(mail(self::$to,'English words','Egnlish words')) {
			echo 'Письсмо отправлено';
		} else {
			echo 'Письмо не отправилось';
		}
		exit();
	}
	static function send() {
		return mail(self::$to,self::$subject,self::$text, self::$headers);
	}
}
