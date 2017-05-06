<?php
	include 'core/init.php';
	$title ="News";
	include 'includes/overall/header.php';?>
	<h1>Your personal news</h1>
	<div id="content">
		<?php
			$user_id=$user_data['user_id'];
			show_user_news($page,$user_id);
?>
	</div>
<?php
	 include'includes/overall/footer.php';
?>
