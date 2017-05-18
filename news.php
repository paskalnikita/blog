<?php
	include 'core/init.php';
	$title ="News";
	include 'includes/overall/header.php';?>
	<h1>Your personal news</h1>
	<div id="content">
		<?php
			if(logged_in()){
				$user_id=$user_data['user_id'];
				if(first_log_in($user_id)){
					echo "Show block with instructions";
					$set_logged_in=mysql_query("UPDATE `users` SET `first_log_in`='0' WHERE `user_id`=$user_id") or die(mysql_error());
				}else{
					show_personal_news($page,$user_id);
					}
			}else{
				echo "Log in first";
			}
?>
	</div>
<?php
	 include'includes/overall/footer.php';
?>
