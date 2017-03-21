<?php
	include 'core/init.php';
	admin_protect();// доступно только администратору
	$title ="Email for users";
	include 'includes/overall/header.php';?>
	<h1>Email for users</h1>
<?php
		if(empty($_POST) === false){
			if(empty($_POST['subject']) === true){
				$errors[] = 'Subject requared!';
			}
			if(empty($_POST['body']) === true){
				$errors[] = 'Body requared!';
			}
			if(empty($errors) === false){
				echo '<div class="errors-output">';
					echo output_errors($errors);
				echo '</div>';
			} else{
				mail_users($_POST['subject'], $_POST['body']);// отравляем email письма пользователям
				echo '<div class="success-output">';
					echo 'Mail successfully sended!';
				echo '</div>';
			}
		}
	?>
	<form action="" method="post">
		<ul>
			<li>
				Subject<br>
				<input type="text" name="subject">
			</li>
			<li>
				Body<br>
				<textarea style="border: 3px solid #40C781;border-radius:3px;" name="body" id="" cols="40" rows="7"></textarea>
			</li>
			<li>
				<input type="submit" value='Send' onclick="return confirm('Are you realy want to send mails?')">
			</li>
		</ul>
	</form>
<?php
include'includes/overall/footer.php';
?>
