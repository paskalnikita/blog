<?php
	include 'core/init.php';
	$title ="Support";
	include 'includes/overall/header.php';?>
	<h1>Contact us</h1> 
	<p>
	<?php
		if(logged_in()){;
			if(!empty($_POST['support_message'])) {
				$message=$_POST['support_message'];
				$date =date("d-M-Y");
				$user_id=$user_data['user_id'];
				$query = mysql_query("INSERT INTO `support`(`user_id`,`message`,`date`) VALUES ('$user_id','$message','$date')");
					echo "<div >You support message has been added to date base. You will get an e-mail notification after solving your problem! <br> Travaster.com</div>";
			}else{?>
			Please field this form fo contacting us:
				<form action="" method='post'>
					<div class="message-box" style="width:630px;height:170px;">
						<textarea id="comment_area" name="support_message" placeholder='Tell us about your problem'></textarea>
						<input type="submit" value='Send' class="submit-button">
					</div>
<?php
				}
		}else{
				echo "Please log in for support";
			}
?>
				</form>
	</p>
<?php
include'includes/overall/footer.php';
?>
