<?php
	include 'core/init.php';
	protect_page();// доступно только аторизированному пользователю
	$title = 'Change password';
	if(!empty($_POST)){
	$required_fields = array('current_password', 'password', 'password_again');
	foreach ($_POST as $key => $value) {
		if(empty($value) && in_array($key, $required_fields)){
			$errors[] = 'Fields empty!';
			break 1;
		}
	}
	if(md5($_POST['current_password']) === $user_data['password']){
		if(trim($_POST['password']) !== trim($_POST['password_again'])){
			$errors[] = 'New passwords not match!';
		} else if(strlen($_POST['password']) < 7){
			$errors[] = 'Password must be at least 7 characters!';
		}
	} else{
		$errors[] = 'Current Password is incorrect!';
	}
}
	include 'includes/overall/header.php';
	?>
		<h1>Change password</h1>
<?php
				if(isset($_GET['force']) && empty($_GET['force'])){// если был редирект после восстановления пароля, просим сменить его
?>
					<p>You must change your password</p>
<?php
				}
				if(!empty($_POST) && empty($errors)){
					change_password($session_user_id, $_POST['password']);
					echo '<div class="success-output">';
						echo "Your password has been changed!";
					echo '</div>';
				} else if(!empty($errors)){
					echo "<div class='errors-output'>";
						echo output_errors($errors);
					echo "</div>";
				}
					?>
					<form action="" method="post">
						<ul>
							<li>
								Current Password:<br/>
								<input type="password" name='current_password'/>
							</li>
							<li>
								New Password:<br/>
								<input type="password" name='password'/>
							</li>
							<li>
								New Password again:<br/>
								<input type="password" name='password_again'/>
							</li>
							<li>
								<input type="submit" value="Change">
							</li>
						</ul>
					</form>
<?php
	include 'includes/overall/footer.php';
?>