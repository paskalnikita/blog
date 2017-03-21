<?
	$DIR=$_SERVER["DOCUMENT_ROOT"];
	include "$DIR/core/init.php";
	$username_gallery = basename(dirname(__FILE__));
	$title = $username_gallery .'\'s gallery';
	include "$DIR/includes/overall/header.php";
	echo "<p align='center'><a href='/user/$username_gallery' style='text-decoration:none;'>$username_gallery</a>'s gallery.</p>";?>
<!-- 		<a href="#" id='Go_Top'>
			<img alt="up" src="/images/up.png">
		</a> -->
	<div id='content'>
		<div class='left'>
<?php
			if($user_data['username'] === $username_gallery) {
				if(!isset($_GET['pic'])) {
					if(isset($_FILES['profile'])){
						if(empty($_FILES['profile']['name'])){
							echo "<div class='img-file-error'>Please choose a file!</div>";
						}else{
							$allowed = array('jpg', 'jpeg', 'gif', 'png');
							$file_name = $_FILES['profile']['name'];
							$file_extn = strtolower(end(explode('.', $file_name)));
							$file_temp = $_FILES['profile']['tmp_name'];
							if(in_array($file_extn, $allowed) === true){
								upload_gallery_image($session_user_id, $file_temp, $file_extn);
								echo "You uploaded photo!";
							}else{
								echo "<div class='img-file-error'>Incorrect file type!<br>
									Allowed types: ";
									echo implode(', ',$allowed);
								echo ".</div>";
								}
							}
					}
					echo'<img id="previewImg" class="img-settings" width="250px" >';
			?>
				<form action="" method="post" enctype="multipart/form-data">
					<input type="file" accept="image/*" onchange="preview(this.value)" name="profile"><br>
					<input class='green-border' type="submit" value="Upload photo">
				</form>
			</div>
<?php
				}
			}
			if(isset($_GET['pic'])){
				$pic=$_GET['pic'];?>
					<div style="margin-top:3px;">
						<div id="triangle-left"></div>
							<div style="text-align:left;background:rgb(64,199,129);width:165px;float:left;height:24px;border-radius:0px 5px 5px 0px;">
								<div style="margin-top:2px; margin-left:15px;">
									<a href="/images/gallery/<?php echo $username_gallery;?>" style='text-decoration:none;'>
										Back to the gallery
									</a>
								</div>
							</div>
					</div>
					<?php 
				if(file_exists($pic) && $pic !='index.php'){ ?>
				<div style="margin-top:35px;">
					<img src='<?=$pic?>' width='640px' class='round' >
				</div>
<?php
		if(logged_in() === true){
			$comment = $_POST['comment'];
			$comment = htmlspecialchars($comment, ENT_QUOTES);
			if(!empty($_POST['comment'])) {
				$user_id = $user_data['user_id'];
				$insert_comment = mysql_query("INSERT INTO `gallery` (`image`,`user_id`,`comment`) VALUES ('$pic','$user_id','$comment')") or die(mysql_error());
				echo "<div class='success-output' style=\"width: 305px;margin-bottom: 2px;margin-left: 3px;\">Your comment has been added!</div>";
			}

				if(!empty($_POST['comment-delete'])){// если нажал удалить комментарий
						$comment_id = $_POST['comment-delete'];
						$result = mysql_query("SELECT * FROM gallery WHERE id = '$comment_id'") or die(mysql_error());
						$comments_data = mysql_fetch_array($result);
						if($user_data['user_id'] === $comments_data['user_id']){
							$record_exists = mysql_query("SELECT * FROM gallery WHERE id = '$comment_id'") or die(mysql_error());// проверяем, есть ли запись в БД
							if(mysql_num_rows($record_exists)){
								$query = mysql_query("DELETE FROM gallery WHERE id = '$comment_id'") or die(mysql_error());// удаляем запись
								echo '<div class="success-output" style="width: 305px;margin-bottom: 2px;margin-left: 3px;">You successfully deleted post!</div>';
							}else{
									echo '<div class="errors-output"style="width: 305px;margin-bottom: 2px;margin-left: 3px;">This post does not exist!</div>';
								}
						}else{
								echo '<div class="errors-output" style="width: 305px;margin-bottom: 2px;margin-left: 3px;">You can\'t delete this post!</div>';
							}
						}
			?>
						<form name="comment_form" action="" method="post">
							<div class="message-box">
								<textarea name="comment" rows="7" id="comment_area"cols="35" placeholder="Leave a comment" required></textarea>
								<div class="clear-box">
									<input class="clear-textarea" type="button" onclick="form.reset()" value="&#x274c;">
								</div>
							</div>
							<div class="mt9">
								<input class='submit-button' type="submit" name="submit" value="Comment"/>
									Symbols left: <b><span id="counter">256</span></b>
							</div>
						</form>
<?php	}else{
		echo'<div class="cannotcomment">You need to be logged in for leaving comments!</div>';
	}
	$gallery_select = mysql_query("SELECT * FROM `gallery` WHERE `image`='$pic'  ORDER BY `id`DESC") or die(mysql_error());
	while ($gallery_comments= mysql_fetch_assoc($gallery_select)){
		echo "<div class='comment'>";
			echo $gallery_comments['comment'];
			echo "<br>";
			$user_id = $gallery_comments['user_id'];
			$username = username_from_id($user_id);
			echo "<div style='float:right'>";
					if(!empty($user_data['username'])){// если авторизирован
						if($user_data['username'] === $username_gallery){// если Я автор комментария, вывести кноку удалить?>
							<div class='delete-post-part' style='margin-top:-24px;margin-right:0px;'>
								<form action="" method="POST">
									<input type="hidden" value='<?php echo $gallery_comments['id'];?>' name='comment-delete'>
									<input type="submit" class='delete-post-link' value='&#10006;' onclick="return confirm('Are you realy want to delete this post?')">
								</form>
							</div>
<?php					}
					}
				echo "<a style='color:#0066CC;' href='/user/$username'>$username' profile</a>";
			echo "</div>";
			echo "<br>";
		echo "</div>";
	}
			}else{
					echo "<br><br><p style='text-align:center;'>ERROR!<br> This picture does not exists!</p>";
				}
			}
			if(!isset($_GET['pic'])){
					get_images();
				}
	echo "</div>";
	include "$DIR/includes/overall/footer.php";
?>