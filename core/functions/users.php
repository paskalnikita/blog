<?php
//зарезервированные имена
	function fixed_names(){
		return array(
			'index','news','post','newspaper','activate','changepassword','login','logout','profile','protected','recover','register','settings',
			'admin','addnews','mail','administrator'
		);
	}
// проверка зарезервированного имени
	function fixed($username){
			$array = fixed_names();
			if(in_array($username,$array)){
				return true;
			}else{
					return false;
				}
		}
// массовая отправка email сообщений пользователям
	function mail_users($subject, $body){
		$query = mysql_query("SELECT `email`, `first_name` FROM `users` WHERE `allow_email` = 1 ");
		while(($row = mysql_fetch_assoc($query)) !== false){
			usleep(100000);
			email($row['email'], $subject, "Hello ".$row['first_name'] .",\n\n" .$body ."\n\n Travaster.com");
		}
	}
// смена аватара пользователя
	function change_profile_image($user_id, $file_temp, $file_extn){
		$file_path = 'images/profile/'.substr(md5(time()), 0, 10) . '.' . $file_extn;
		move_uploaded_file($file_temp, $file_path);
		mysql_query("UPDATE `users` SET `profile` = '" . mysql_real_escape_string($file_path) . "' WHERE `user_id` = " . (int)$user_id);
	}
// проверка на тип аккаунта
	function is_admin($user_id){
		$user_id = (int)$user_id;
		return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `user_id` = $user_id AND `type` = 1"), 0) == 1) ? true : false ;
	}
// восстановление пароля или имени пользоватля
	function recover($mode, $email){
		$mode = sanitize($mode);
		$email = sanitize($email);
		$user_data = user_data(user_id_from_email($email), 'user_id', 'first_name', 'username');
		if($mode == 'username'){
			email($email, 'Your username', "Hello " . $user_data['first_name'] . "!\n\nYour username is: " . $user_data['username'] . ".\n\n Please do not reply to this message.\n -Travaster.com");
		}else if($mode == 'password'){
			$generated_password = substr(md5(rand(999, 9999999)), 0, 7);
			change_password($user_data['user_id'], $generated_password);
			update_user($user_data['user_id'], array ('password_recover' => '1'));
			email($email, 'Your password', "Hello " . $user_data['first_name'] . "!\n\nYour new password is: " . $generated_password . ".\n\nPlease log in using this password \n\n Please do not reply to this message.\n -Travaster.com");
		}
	}
// обновление информации о пользователе
	function update_user($user_id, $update_data){
		$update = array();
		array_walk($update_data, 'array_sanitize');
		foreach($update_data as $field => $data) {
			$update [] = '`' . $field . '` = \'' . $data .'\'';
		}
		mysql_query("UPDATE `users` SET ". implode(', ', $update) ." WHERE `user_id` = $user_id");
	}
// активация аккаунта после перехода по сслыке из письма
	function activate($email, $email_code){
		$email			= mysql_real_escape_string($email);
		$email_code		= mysql_real_escape_string($email_code);
		if(mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `email_code` = '$email_code' and `active` = 0"), 0) == 1) {
			mysql_query("UPDATE `users` SET `active` = 1 WHERE `email` = '$email'");
			return true;
		}else{
			return false;
		}
	}
// смена пароля
	function change_password($user_id, $password){
		$user_id = (int)$user_id;
		$password = md5($password);
		mysql_query("UPDATE `users` SET `password` = '$password', `password_recover` = 0 WHERE `user_id` = $user_id");
	}
// регистрация пользователя
	function register_user($register_data){
		array_walk($register_data, 'array_sanitize');
		$register_data['password'] = md5($register_data['password']);
		$fields = '`' . implode('`, `', array_keys($register_data)) . '`' ;
		$data = '\'' . implode('\', \'', $register_data) . '\'';
		mysql_query("INSERT INTO `users` ($fields) VALUES ($data)") or die(mysql_error());
		email($register_data['email'], 'Activate your account',"Hello " .$register_data ['first_name'].",\n\nYou need to activate your account, use the link below : \n\nhttp://paskalnikita.com/activate?email=".$register_data['email']."&email_code=".$register_data['email_code']."\n\n -Travaster.com");
	}
// подсчет зарегистирированных пользователей, активировавших аккаунт
	function user_count(){
		return mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `active` = 1"), 0);
	}
// получение массива с информацией о пользователе
	function user_data($user_id){
		$data = array();
		$user_id = (int)$user_id;
		$func_num_args = func_num_args();
		$func_get_args = func_get_args();
		if($func_num_args > 1){
			unset($func_get_args[0]);
			$fields = '`' . implode('`, `' ,$func_get_args) . '`';
			$data = mysql_query("SELECT $fields FROM `users` WHERE `user_id` = $user_id") or die(mysql_error());
			$data = mysql_fetch_assoc($data);
			return $data;
		}
	}
//функция запонить меня(куки)
	function user_remember( $id, $token ){
			mysql_query("UPDATE `users` SET `remember_token` = '$token' WHERE `user_id` = '$id'");
	}
// проверка на залогиненость пользователя
	function logged_in(){
		if(isset($_SESSION['user_id'])){
				return true;
		}
	if(isset($_COOKIE['authtoken'])){
		$token = sanitize($_COOKIE['authtoken']);
		$user_id = mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `remember_token` = '$token'"), 0);
		$_SESSION['user_id'] = $user_id;
		return true;
	}
	return false;
}

//делаем пользователя онлайн
	function setOnline($user_id){
		$user_last_action_time = time();
		$query=mysql_query("UPDATE `users` SET `online_time`='$user_last_action_time' WHERE `user_id`='$user_id'") or die(mysql_error());
	}

//определение онлайн ли пользователь
	function getOnline($profile_id){
		$get_time_query=mysql_query("SELECT `online_time` FROM `users` WHERE `user_id`='$profile_id'") or die(mysql_error());
		$get_online_time=mysql_fetch_assoc($get_time_query);
		$last_action_time=$get_online_time['online_time'];
		if(time()-$last_action_time<=300){ // 300 - время в секундах, то есть по истечении 5 минут неактивности пользователь считается оффлайн
			echo 'Online';
		}else{
			echo 'Offline';
			echo '<br> Last activity: '.date('d-m-Y H:i',$last_action_time);
			}
	}

//определение онлайн ли пользователь
	function users_online(){
		$current_time=time();
		$online_time =$current_time-300;
		$query = mysql_query("SELECT COUNT(*) AS `online` FROM `users` WHERE `online_time` > '$online_time'") or die(mysql_error());
			while($row = mysql_fetch_array($query)){
				echo 'Users online: <b>'.$row['online'].'</b>.';
			}
		}


// проверка на существование записи в БД на никнейм пользователя
	function user_exists($username){
		$username = sanitize($username);
		return(mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'"), 0) == 1) ? true : false;
	}
// проверка не был ли использован данный email ранее
	function email_exists($email){
		$email = sanitize($email);
		return(mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'"), 0) == 1) ? true : false;
	}
// активация аккаунта пользователя
function user_active($username){
	$username = sanitize($username);
	return(mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `active` = 1 "), 0) == 1) ? true : false;
}
// получение id пользователя из его никнейма
function user_id_from_username($username){
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `username` = '$username'"), 0, 'user_id');
}
// получение id пользователя из его email
function user_id_from_email($email){
	$email = sanitize($email);
	return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `email` = '$email'"), 0, 'user_id');
}
// получение никнейма пользователя из его id
function username_from_id($user_id){
	$user_id = sanitize($user_id);
	return mysql_result(mysql_query("SELECT `username` FROM `users` WHERE `user_id` = '$user_id'"), 0, 'username');
}
// залогиневание пользователя
function login($username, $password){
	$user_id = user_id_from_username($username);
	$username = sanitize($username);
	$password = md5($password);
	return(mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'"), 0) == 1) ? $user_id : false;
}
// запись личного сообщения в БД !!!(не используется)!!!
	function add_message($from,$to,$message){
		$date = date('Y.m.d');
		$time = date("H:i:s");
		$query = mysql_query("INSERT INTO `messages` (`to`,`from`,`message`,`date`,`time`) VALUES ('$to','$from','$message','$date','$time')") or die(mysql_error());// добавляем сообщеине в БД
	}
?>