<?php
	include 'core/init.php';
	$title = "Log In";
	logged_in_redirect();// только для НЕавторизированных пользователей
	include 'includes/overall/header.php';
	if(empty($_POST) === false){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(empty($username) === true || empty($password)){
			$errors[] = 'Write a password and username';
		}else if(user_exists($username) === false){
			$errors[] = 'Cant find username';
		}else if(user_active($username) === false){
			$errors[] = 'You didn\'t activate your account!';
		}else{
			if(strlen($password)>32){
				$errors[] = 'Password too long';
			}
			$login=login($username, $password);
				if($login === false){
					$errors[] = 'Combinatoin of username and password incorrect!';
				}else{
					$_SESSION['user_id']= $login;
				$ip=getenv("HTTP_X_FORWARDED_FOR");
				if(empty($ip) || $ip=='unknown'){ $ip=getenv("REMOTE_ADDR"); }
					if(isset($_POST['save'])){
						$token = md5( md5( $_POST["password"] ) . $ip );
						setcookie("authtoken", $token, time()+9999999);
						user_remember( $login, $token);// запоминаем куку, если выбрали запонить меня
					}
					logged_in_redirect();
				}
			}
}else{
	$errors[] = 'No data';
	}
	if(empty($errors) === false){
?>
	<h2>Tried to log in ,but...</h2>
<?php
	echo output_errors($errors);// вывод ошибок, если есть
	}
	include 'includes/overall/footer.php';
?>
