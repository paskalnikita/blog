<?php
	include 'core/init.php';
	logged_in_redirect();// только для НЕавторизированных пользователей
	$title = 'Register';
	include 'includes/overall/header.php';
	if(!empty($_POST)){
		$required_fields = array('username', 'password', 'password_again', 'first_name', 'email');
		foreach ($_POST as $key => $value){
			if(empty($value) && in_array($key, $required_fields)){
				$errors[] = 'Fields empty!';
				break 1;
			}
		}
		if(empty($errors)){
			if(user_exists($_POST['username'])){
				$errors[] = 'Sorry username \''. $_POST['username'] . '\' already taken!';// проверка на никнейм пользователя
			}
			if(fixed($_POST['username'])){
				$errors[] = 'Name \''. $_POST['username'] . '\' reserved!';// зарезервированные никнеймы
			}
			if(preg_match("/\\s/", $_POST['username'])){
				$errors[] = 'Your username must not contain any spaces!';// не должно быть пробелов
			}
			if(!preg_match("/^([a-z]|[A-Z]|_|-|[0-9])+$/",$_POST['username'])){
				$errors[] = "Your username contains invalid characters!";//достуные символы в никнейме
			}
			if(strlen($_POST['username']) < 2 or strlen($_POST['username']) > 32){
				$errors[] = "You username must be more than 2 simbols and less than 32 simbols!";// проверка длины никнейма
			}
			if(strlen($_POST['password']) < 7){
				$errors[] = 'Password must be at least 7 characters!';// проверка длины пароля
			}
			if($_POST['password'] !== $_POST['password_again']){// совпадают ли поля для посторения пароля
				$errors[] = 'Your password do not match!';
			}
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){// проверка email
				$errors[] = 'A valid email adress is requared!';
			}
			if(email_exists($_POST['email'])){
				$errors[] = 'Sorry, the email \'' .$_POST['email'] . '\' is already in use';// занят ли никнейм
			}
		}
	}
?>
		<h1>Register</h1>
<?php
		if(!empty($_POST) && empty($errors)){
						$reg_date = date('d.m.Y');// дата регистрации
						$ip = $_SERVER["REMOTE_ADDR"];
						$register_data = array(
							'username'		=> $_POST['username'],
							'password'		=> $_POST['password'],
							'first_name'	=> $_POST['first_name'],
							'last_name'		=> $_POST['last_name'],
							'email'			=> $_POST['email'],
							'reg_date'		=> $reg_date,
							'ip'				=> $ip,
							'email_code'	=> md5($_POST['username'] + microtime())
				);
			register_user($register_data);
			$reg_email = $_POST['email'];
			$reg_email = preg_replace('~.+@(.+)~', '<a href="https://www.$1">email adress</a>', $reg_email);
			echo "<div class='success-registration'>";
				echo "You created your account! Check your $reg_email for logining in!";// выводим ссылку на email
			echo "</div>";
		} else if(!empty($errors)){
			echo "<div class='errors-output'>";
				echo output_errors($errors);
			echo "</div>";
		}
?>
		<form action="" method="post">
			<ul>
				<li>
					Username:<br/>
					<input type="text" name="username" class="reg-input">
				</li>
				<li>
				Password:<br/>
					<input type="password" name="password" id="password" class="reg-input">
				</li>
				<div id="password-indicator" class="reg-input"></div>
				<li>
				Password again:<br/>
					<input type="password" name="password_again" class="reg-input">
				</li>
				<li>
					First name:<br/>
					<input type="text" name="first_name" class="reg-input" onkeyup="lettersOnly(this)">
				</li>
				<li>
					Last name:<br/>
					<input type="text" name="last_name" class="reg-input" onkeyup="lettersOnly(this)">
				</li>
				<li>
					Email:<br/>
					<input type="text" name="email" class="reg-input">
				</li>
				<li>
					<input type="submit" value="Register" class="reg-input">
				</li>
			</ul>
		</form>
<?php
	include 'includes/overall/footer.php';?>