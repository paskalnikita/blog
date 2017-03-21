	<aside>
<?php
	$DIR=$_SERVER["DOCUMENT_ROOT"];
		if(logged_in() === true){
			include '/widgets/loggedin.php';// вывод меню для авторизированного пользователя
		}else{
			include '/widgets/login.php';// вывод меню для неавторизированного пользователя
		}
		include 'widgets/adds.php';
		include "$DIR/includes/widgets/user_count.php";
?>
	</aside>