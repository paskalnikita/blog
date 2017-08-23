<?php
	include 'core/init.php';
	$title ="Main";
	include 'includes/overall/header.php';?>
	<h1>Home</h1>
	<div id="content">
<?php
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
			if(logged_in()){
				show_news($page);
			}else{//если не залогиинен
				echo "<div class='post animated slideInLeft'>";
				echo "Do you like to travel? Tell us your story!
					<br><br>
					<img src='images/palm.png' width='120px' class='left-img'>
					The main idia of this page is traeling. This is a some kind of social network for travelers.
					Show photos, write blogs.Let everyone know everything about all places you visit. And see photos of orther users. Contact with them.
					Travel more as much as you can!
					
					<img src='images/25.png' width='120px' class='right-img'>
					<br>
					<br>

					Registration is very simple just <a href='/register' class='user-menu' style='padding:5px;'>click here</a> and join our comunity!<br><br>

					Travaster.com is a new growing project,which don't have a team. If you want to help this project,please visit <a href='/contact'>contact page</a>
					and write down in which sphere you can support this project. Also you can visit <a href='https://www.patreon.com/paskalnikita'>Patreon page</a>.
					";
				echo "</div>";
		}
	?>
	</div>
<?php
		include'includes/overall/footer.php';
?>