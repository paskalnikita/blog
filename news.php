<?php
	include 'core/init.php';
	$title ="News";
	include 'includes/overall/header.php';?>
	<h1>News</h1>
	<div id="content">
		<?php
				show_news($page);
?>
	</div>
<?php
	 include'includes/overall/footer.php';
?>
