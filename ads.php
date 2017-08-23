<?php
	include 'core/init.php';
	$title ="Advertising";
	protect_page();
	include 'includes/overall/header.php';?>
	<h1>Advertising</h1>
	<div id='content'>
<?php
		if(!empty($_POST['ads_message'])){// если не пустое сообщение
		$message=sanitize($_POST['ads_message']);
		$date =date("d-M-Y");
		$email = sanitize($_POST['email']);
		$query = mysql_query("INSERT INTO `ads`(`message`,`email`,`date`) VALUES ('$message','$email','$date')") or die(mysql_error());
			echo "<div class='success-ads-output'>
				Thank you ".$user_data['first_name']."!
				<br>
				You advertising message has been added to our database.
				 You will get an e-mail notification after we see your request! <br><br> Travaster.com</div>";
	}else{
		echo "Please field this form fo contacting us:<br>";
		show_contact_system_for_ads();
		}
include'includes/overall/footer.php';
?>