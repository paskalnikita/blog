<?php
	include 'core/init.php';
	admin_protect();// доступно только администратору
	$title ="Add article";
	include 'includes/overall/header.php';?>
	<h1>Adding articles</h1> 
		<form action="" method="post">
			<input type="text" class='submit-button' placeholder="Title" name="title">
			<input type="text" class='submit-button' placeholder="Header" name='header'>
			<textarea class='submit-button' name="m_desc" rows="7" cols="75" placeholder="Mini description" style='resize:vertical ;' required></textarea>
			<textarea class='submit-button' name="desc" rows="7" cols="75" placeholder="Full description" style='resize:vertical ;' required></textarea>
			<br>
<?php
					$date = date('Y.m.d');
					echo $date;?>
					<br>
			<input type="Submit" value='Add' class='submit-button'>
		</form>
<?php
include'includes/overall/footer.php';
?>
