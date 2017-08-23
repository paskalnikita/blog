<?php
	include 'core/init.php';
	admin_protect();
	$title ="Admin panel";
	include 'includes/overall/header.php';?>
	<div id="content">
	<h1>Admin panel</h1>

			support messages: <br>
			dev mesasges: <br>
			contact messages: <br>
			ads messages: <br>
<?php
		users_online();
include'includes/overall/footer.php';
?>
