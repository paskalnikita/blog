<?php
	include 'core/init.php';
	$title ="Support";
	protect_page();
	include 'includes/overall/header.php';?>
	<h1>Support</h1>
	<div id='content'>
	<?php
			if(!empty($_POST['support_message'])){// и не пустая каринка еще сдалй чтобы потом перместатить файл и схаписать в бд
				$message=sanitize($_POST['support_message']);
				$date =date("d-M-Y");
				$user_id=$user_data['user_id'];
					if(isset($_FILES['picture'])){
						$allowed = array('jpg', 'jpeg', 'gif', 'png');
						$file_name = $_FILES['picture']['name'];
						$file_extn = strtolower(end(explode('.', $file_name)));
						$file_temp = $_FILES['picture']['tmp_name'];
						if(in_array($file_extn, $allowed)){
							upload_support_image($file_temp,$file_extn);
							//сделать проверку на то что загружается не картинка и не записывать ее название в БД
								if($_FILES['picture']['name'] == ""){//если не была загружена картинка выставить ее имя на 0.jpg
									$pic ="0.jpg";
								}else{
									$pic =time().".jpg";
								}
						}else{
							if($_FILES['picture']['name'] != ""){
								echo "<div class='img-file-error'>Incorrect file type!<br>
									Allowed types: ";
									echo implode(', ',$allowed);
								echo ".</div>";
								$pic_error=1;
								}
							}
							if($pic_error==1){//если попытались загрузить не картинку на сервер вывожу ошибку то ничего не записалось
								echo "<div class='errors-support-output'>
									Oooops! ".$user_data['first_name']."!
									<br>
									Seems that you tried to upload non supportable image! Try again with write extention file!<br><br> Travaster.com</div>";
								echo "Please field this form fo contacting us:<br>";
								show_upload_pic_system_for_support();
							}
							//данноe сообщение выводится еще тогда, когда я пытаюсь загрузит ьне картинку!
							if($pic_error!=1){
								$query = mysql_query("INSERT INTO `support`(`user_id`,`message`,`pic`,`date`) VALUES ('$user_id','$message','$pic','$date')") or die(mysql_error());
								echo "<div class='success-support-output'>
									Thank you ".$user_data['first_name']."!
									<br>
									You support message has been added to database. You will get an e-mail notification after solving your problem! <br><br> Travaster.com</div>";
							}
						}
			}else{
				echo "Please field this form fo contacting us:<br>";
				show_upload_pic_system_for_support();
				}
include'includes/overall/footer.php';
?>
