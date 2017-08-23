<?php
	include 'core/init.php';
	$title ="Contact us";
	include 'includes/overall/header.php';?>
<h1>Contact us</h1>
<div id="content">
<?php
	if(!empty($_POST['contact-message'])){
		$message=sanitize($_POST['contact-message']);
		$email=$user_data['email'];
		$date=date("d-M-Y");
		$query = mysql_query("INSERT INTO `contact`(`message`,`email`,`date`) VALUES ('$message','$email','$date')") or die(mysql_error());
			echo "<div class='success-dev-output'>
				Thank you ".$user_data['first_name']."!
				<br>
				You dev message has been added to database.
				 You will get an e-mail notification after we see your request! <br><br> Travaster.com</div>";
	}else{
		if(logged_in()){
				echo "Please field this form for contacting us";?>
				<form action='' method='post'>
					<br>
					<div class="message-box">
						<textarea id="comment_area" cols="50" rows="7" name="contact-message" placeholder='Please,leave a message'></textarea>
						<input type="submit" value='Send' class="submit-button">
					</div>
				</form>
<?php
			}else{
				echo "Please,log in for contaacting us!";
			}
		}
?>
<?php
include'includes/overall/footer.php';
?>
