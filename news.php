<?php
	include 'core/init.php';
	$title ="News";
	protect_page();
	include 'includes/overall/header.php';?>
	<h1>Your personal news</h1>
	<div id="content">
		<?php
				$user_id=$user_data['user_id'];
				if(first_log_in($user_id)){// убери !-  это для теста
						echo "Here is some recomendations for you!<br>";
						show_recommendations();
						//поменять
						$set_logged_in=mysql_query("UPDATE `users` SET `first_log_in`='0' WHERE `user_id`=$user_id") or die(mysql_error());
					}else{
						show_personal_news($page,$user_id);
				}
?>
	</div>
<?php
	 include'includes/overall/footer.php';
?>
