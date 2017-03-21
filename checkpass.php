<?php
$password = $_POST['password'];
	if(strlen($password) < 4){
		$html = '<div style="background:#FF4040; width:25%; height:10px;border-radius:3px;"></div>';
	}
	else{
		$strong = 0;
		//Проверяем, есть ли в пароле числа
		if(preg_match("/([0-9]+)/", $password)){
			$strong++;
		}
		//Проверяем, есть ли в пароле буквы в нижнем регистре
		if(preg_match("/([a-z]+)/", $password)){
			$strong++;
		}
		//Проверяем, есть ли в пароле буквы в верхнем регистре
		if(preg_match("/([A-Z]+)/", $password)){
			$strong++;
		}
		//Проверяем, есть ли в пароле спецсимволы
		if(preg_match("/\W/", $password)){
			$strong++;
		}
		//В зависимости от сложности пароля выводим полоски
		if($strong == 0){
			$html = '<div style="background:#ff0000; width:25%; height:10px;border-radius:3px;"></div>';
		}
		if($strong == 1){
			$html = '<div style="background:#FCAC3A; width:50%; height:10px;border-radius:3px;"></div>';
		}
		if($strong == 2){
			$html = '<div style="background:#FFCC33; width:75%; height:10px;border-radius:3px;"></div>';
		}
		if($strong == 3){
			$html = '<div style="background:#40C781; width:100%; height:10px;border-radius:3px;"></div>';
		}
	}
echo $html;
?>