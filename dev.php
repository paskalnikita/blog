<?php
	include 'core/init.php';
	$title ="Developers";
	protect_page();
	include 'includes/overall/header.php';?>
	<h1>Developers page</h1>
	<div id='content'>
<?php
	if(!empty($_POST['dev_message'])){// если не пустое сообщение
		$message=sanitize($_POST['dev_message']);
		$date =date("d-M-Y");
		$email = sanitize($_POST['email']);
		$query = mysql_query("INSERT INTO `developers`(`message`,`email`,`date`) VALUES ('$message','$email','$date')") or die(mysql_error());
			echo "<div class='success-dev-output'>
				Thank you ".$user_data['first_name']."!
				<br>
				You dev message has been added to database.
				 You will get an e-mail notification after we see your request! <br><br> Travaster.com</div>";
	}else{
		echo "Please field this form fo contacting us:<br>";
		show_contact_system_for_dev();
		}
include'includes/overall/footer.php';
?>
