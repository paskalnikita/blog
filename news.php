<?php
	include 'core/init.php';
	$title ="News";
	include 'includes/overall/header.php';?>
	<h1>Your personal news</h1>
	<div id="content">
		<?php
			if (logged_in()) {
				$user_id=$user_data['user_id'];
				show_personal_news($page,$user_id);
			}else{
				echo "Log in first";
			}
?>
	</div>
<?php
	 include'includes/overall/footer.php';
?>
