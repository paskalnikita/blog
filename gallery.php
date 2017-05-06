<?php
	include 'core/init.php';
	$title ="Gallery";
	include 'includes/overall/header.php';?>
	<h1>Users gallery</h1>
	<div id="content">
<?php
		if(!isset($_GET['pic']) && !isset($_GET['username'])){
			show_gallery_pics();
		}
		if(isset($_GET['pic'])){
			$user_id=$user_data['user_id'];
			$pic_id=$_GET['pic'];
			if(logged_in()){
				$query = mysql_query("SELECT * FROM gallery_pics WHERE `id` = '$pic_id'");
				$picture = mysql_fetch_array($query);
				$username_gallery = username_from_id($picture['user_id']);
					if($username_gallery !=$user_data['username']){
						if(isset($_POST['like-pic'])){
							if(!pic_is_liked($pic_id,$user_id)){
								like_pic($pic_id,$user_id);
							}
						}
						if(isset($_POST['unlike-pic'])){
							unlike_pic($pic_id,$user_id);
						}
					}
					if($username_gallery==$user_data['username']){
						if(isset($_POST['delete-pic'])){
							delete_pic($pic_id,$username_gallery);
						}
					}
			}
		show_user_gallery_pic();
			if(logged_in()){
				if(!empty($_POST['comment'])){//отправлен ли окментарий
					$comment=$_POST['comment'];
					add_pic_comment($pic_id,$user_id,$comment);
				}
				show_comments_form();
			}
			if(isset($_POST['delete-pic-comment'])){
				$pic_commnet_id=$_POST['delete-pic-comment'];
				delete_pic_comment($pic_commnet_id);
			}
			show_pic_comments($pic_id);
		}
		if(isset($_GET['username'])){
			$username = $_GET['username'];
			$user_id = user_id_from_username($username);
			if(user_exists($username)){
				if($_GET['username'] === $user_data['username']){?>
						<div style='float:left; width: 615px; text-align: left;'>
							<?php total_pics($user_id);?>
							<div class='green-button' style='float: right;margin-bottom: 5px;' >
								<a href='/addphoto'>Add photo</a>
							</div>
						</div>
					<?php
				}
				show_user_pics();
			}else{
				echo "Error! This gallery does not exist!";
			}
		}
include'includes/overall/footer.php';
?>