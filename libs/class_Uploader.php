<?php
class Uploader {
	static $filename;
	static $error;

	static function upload($var){
		$array = ['image/jpeg','image/jpg','image/gif','image/png'];
		$array2 = ['jpeg','jpg','gif','png'];
		if($var['error'] != 0) {
			$res = 'Вы не выбрали файл!';
		} elseif($var['size'] < 5000 || $var['size'] > 50000000) {
			$res = 'Размер изображения не подходит!';
		} else {
			preg_match('#\.([a-z]+)$#iu',$var['name'],$matches);
			if(isset($matches[1])) {
				$matches[1] = mb_strtolower($matches[1]);

				$temp = getimagesize($var['tmp_name']);
				$res = date('Ymd-His').'img'.rand(10000,99999).'.'.$matches[1];

				if(!in_array($matches[1],$array2)) {
					$res = 'Не подходит расширение изображения';
				} elseif($temp[0]/$temp[1] <= 0.2 || $temp[1]/$temp[0] <= 0.2){
					$res = 'Изображение неверной пропорции! Ошибка загрузки';
				} elseif(!in_array($temp['mime'],$array)) {
					$res = 'Поддерживаются форматы: jpg,gif,png';
				} elseif(!move_uploaded_file($var['tmp_name'],'./uploaded/original/'.$res)) {
					$res = 'Изображение не загружено! Ошибка!';
				}
			}
		}
		if(preg_match('#[а-я]+#iu', $res)) {
			self::$error = $res;
			return false;
		} else {
			self::$filename = $res;
			return true;
		}
	}

	static function resize($max_width,$max_height,$folder_output){
		$array = ['image/jpeg','image/jpg','image/gif','image/png'];
		$info = getimagesize('./uploaded/original/'.self::$filename);
		$width = $info[0];
		$height = $info[1];

		if ($width > $max_width) {
			$height = ($max_width / $width) * $height;
			$width = $max_width;
		}
		if ($height > $max_height) {
			$width = ($max_height / $height) * $width;
			$height = $max_height;
		}

		if ($info['mime'] == 'image/jpeg') {
			$temp = imagecreatefromjpeg('./uploaded/original/'.self::$filename);
		} elseif ($info['mime'] == 'image/png') {
			$temp = imagecreatefrompng('./uploaded/original/'.self::$filename);
		} elseif ($info['mime'] == 'image/gif') {
			$temp = imagecreatefromgif('./uploaded/original/'.self::$filename);
		}
		$tmp = imagecreatetruecolor($width,$height);
		imagecopyresampled($tmp,$temp,0,0,0,0,$width,$height,$info[0],$info[1]);
		$res = '/uploaded/'.$folder_output.'/'.self::$filename;
		imagejpeg($tmp,'.'.$res,100);
		imagedestroy($tmp);
		return $res;
	}
}