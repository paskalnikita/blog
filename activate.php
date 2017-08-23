<?php
	include 'core/init.php';
	logged_in_redirect();// доступно только НЕавторизированным пользователям
	$title = "Activating";
	include 'includes/overall/header.php';
	echo "<div id='content'>";
	if(isset($_GET['success']) && empty($_GET['success'])){
	}else if(isset($_GET['email'], $_GET['email_code'])){
		$email			= trim($_GET['email']);
		$email_code		= trim($_GET['email_code']);
		if(!email_exists($email)){
			$errors[] = 'We couldnt find your email!';
		} else if(!activate($email, $email_code)){
			$errors[] = 'We have problems activating your account!';
		}
		if(!empty($errors)){?>
			<h2>Oops...</h2>
			<p>Please, сheck the spelling of links!</p>
<?php
		echo "<div class='errors-output' style='float:left;'>";
			echo output_errors($errors);
		echo "</div>";
		}else{?>
			<h2>Success!</h2>
			<div class='success-output'>
				<p>Thanks, you activated your accaunt!</p>
			</div>
				<br>
				<p>Now you can log in!</p>
<?php
		}
	}
	else{
		echo "<h2>Oops...</h2>";
		echo 'Query for activating is empty!';
	}
	include 'includes/overall/footer.php';
?>