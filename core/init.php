<?php
	session_start();
	header('Content-type: text/html; charset=utf-8');
		error_reporting(-1);// вывод ошибок
		ini_set("display_errors",0);// вывод ошибок
		error_reporting(E_ALL);// вывод ошибок
		error_reporting(E_ALL & ~E_NOTICE);// вывод ошибок
	require 'database/connect.php';// подлючение к бд
	mysql_query("set names utf8");
	require 'functions/general.php';// функции
	require 'functions/users.php';// функции
	include "ip/geoip/geoip.php"; //конфигурация ip
	$current_file = explode( '/', $_SERVER['SCRIPT_NAME']);
	$current_file = end($current_file);
	if(logged_in()){
		global $user_data;
		$session_user_id = $_SESSION['user_id'];
		$user_data = user_data($session_user_id,
								'user_id','username','password','first_name','last_name','email',
								'password_recover','profile','country','state','city','street','house_number',
								'zip_code','gender','birth_day','birth_month','birth_year','active','type','allow_email','ip');//выборка значений из бд для массива о пользователе
		if(user_active($user_data['username']) === false){
			session_destroy();
			header('Location: index');
			exit();
		}
		setOnline($user_data['user_id']);
		//если пароль был восстановлен прошу поменять его на новый
		if($current_file != 'changepassword.php' && $current_file !== 'logout.php' && $user_data['password_recover'] ==1) {
			header('Location: changepassword?force');
			exit();
		}
	}
	$errors = array();
?>