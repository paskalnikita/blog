<?php
	header('Content-type: text/html; charset=utf-8');
	include 'core/init.php';
	logged_in_redirect();
	$title = 'Recover';
	include 'includes/overall/header.php';?>
		<h1>Recover</h1>
<?php
		$mode_allowed = array('username', 'password');// что можно восстанвить
		$email = $_POST['email'];
		$email = preg_replace('~.+@(.+)~', '<a href="http://www.$1">email</a>', $email);// формируем ссылку на почту пользователя
		if(isset($_GET['mode']) === true && in_array($_GET['mode'],$mode_allowed) === true){
			$recover_type = $_GET['mode'];
			echo "Your are recovering $recover_type!";
			if(isset($_POST['email']) === true && empty($_POST['email']) === false){
				if(email_exists($_POST['email']) === true){
					recover($_GET['mode'], $_POST['email']);
					echo '<div class="success-output">';
						echo "Thanks, check your $email!";
					echo "</div>";
				} else{
					echo "<div class='errors-output'>";
						echo "We could not find this email!";
					echo "</div>";
				}
			}?>
			<form action="" method="post">
				<ul>
					<li>
						Please enter your email adress:<br>
						<input type="text" name="email">
					</li>
					<li>
						<input type="submit" value="Recover">
					</li>
				</ul>
			</form>
<?php
		}else{
			echo "<div class='errors-output'>";
				echo "You din't select recover type!";
			echo "</div>";?>
			<ul>
				<li>
					You can recover <a href="recover?mode=username">username</a> or <a href="recover?mode=password">password</a>.
				</li>
			</ul>
<?php
		}
	include 'includes/overall/footer.php';?>