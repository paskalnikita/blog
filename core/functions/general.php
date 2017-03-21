<?php

//отправка email всем
	function email($to, $subject, $body){
		mail($to, $subject, $body, 'From: admin@travaster.com');
	}

//редирект после залогиненвания
		function logged_in_redirect(){
		if(logged_in() === true){
			header ('Location: index');
			exit();
		}
	}

//страница,достпуная авторизированным пользователям
		function protect_page(){
		if(logged_in() === false){
			header ('Location: protected');
			exit();
		}
	}
// страница, доступная только администратору
	function admin_protect(){
		global $user_data;
		if(is_admin($user_data['user_id']) === false){
			header('Location: index');
			exit();
		}
	}
//убираю лишние символы HTML
	function array_sanitize(&$item){
		$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
	}
//убираю лишние символы HTML
	function sanitize($data){
		return htmlentities(strip_tags(mysql_real_escape_string($data)));
	}
// вывод массива ошибок списком
		function output_errors($errors){
			$output = array();
			foreach($errors as $error){
				$output[] = '<li>' .$error . '</li>';
			}
			return '<ul><li>' . implode('</li><li>', $output) .'</li></ul>';
	}
//загрузка картинки в галерею
	function upload_gallery_image($user_id, $description, $file_temp, $file_extn){
		global $user_data;
		$user_id = $user_data['user_id'];
		$file_path = "Z:/home/paskalnikita.com/www/images/gallery/";
		$_ = scandir($file_path);
		$file_path.= time().$user_id.".jpg";
		$pic_name = time().$user_id.".jpg";
		$upload_date = date("d M Y");
		move_uploaded_file($file_temp,$file_path);
		$query = mysql_query("INSERT INTO `gallery_pics` (`user_id`,`description`,`pic_name`,`upload_date`) VALUES ('$user_id','$description','$pic_name','$upload_date')") or die(mysql_error());
		}
// вывод всех картинок из паки в общую галлерею
	function show_gallery_pics(){
		$query = mysql_query("SELECT * from ( SELECT * FROM (SELECT * FROM gallery_pics ORDER BY rand()) AS x GROUP BY user_id) as y  ORDER BY rand() LIMIT 10");
		$pics = mysql_fetch_assoc($query);
		do{
			$username_gallery = username_from_id($pics['user_id']);
			$pic_url = $pics['pic_name'];
			$pic_id = $pics['id'];?>
			<div class='poster'>
				<a href='gallery/pic/<?php echo $pic_id;?>'>
					<img height=' 150px' class='round' width='150px' style='margin-right:5px;' src='http://www.paskalnikita.com/images/gallery/<?php echo $pic_url;?>'>
				</a>
				<div class='descr'>
					Author:
						<a href='user/<?php echo $username_gallery;?>' style='text-decoration:none;'>
							<?php echo $username_gallery;?>
						</a>
				</div>
			</div>
			<?
		}
	while($pics = mysql_fetch_assoc($query));
	}
// вывод картинки в галлереи
	function show_user_gallery_pic(){
		global $user_data;
		$user_id=$user_data['user_id'];
		$pic_id = $_GET['pic'];
		$query = mysql_query("SELECT * FROM gallery_pics WHERE `id` = '$pic_id'");
		$picture = mysql_fetch_array($query);
		$pic = 'images/gallery/'.$picture['pic_name'];
		if(file_exists($pic) &&  $pic!='images/gallery/'){
			$username_gallery = username_from_id($picture['user_id']);
				echo "<div style='float:right;margin-top:5px;text-align:center;background:rgb(64,199,129);padding:2px 7px;border-radius:5px;'>";
					echo "<a href='/user/$username_gallery' style='text-decoration:none;flaot:right;'>";
						echo $username_gallery;
					echo "</a>";
				echo "</div>";?>
					<div style="margin-top:3px;">
						<div id="triangle-left"></div>
							<div style="text-align:left;background:rgb(64,199,129);width:165px;float:left;height:24px;border-radius:0px 5px 5px 0px;">
								<div style="margin-top:2px; margin-left:15px;">
									<a href="/gallery/<?php echo $username_gallery;?>" style='text-decoration:none;'>
										Back to the gallery
									</a>
								</div>
							</div>
					</div>
					<?php
				$pic_url = 'http://www.paskalnikita.com/images/gallery/'.$picture['pic_name'];
				echo "<div class='user-gallery-pic'>";
					echo "<img height='650px' class='round' width='650px' style='margin-right:5px;' src='$pic_url'>";
						echo "<div class='upload-date-user-pic' title='Upload date'>";
							echo $picture['upload_date'];
						echo "</div>";
					if(logged_in()){
						if($user_data['username']!=$username_gallery) {
							show_like_system($pic_id,$user_id);// поставить или убрать лайк
						}
						if($username_gallery==$user_data['username']){?>
							<div class='wrap-delete-pic'>
							<form action="" method="POST">
								<input type="submit" name="delete-pic" class="delete-pic" value='✖' onclick="return confirm('Are you realy want to delete this photo(you can not restore it later)?')">
							</form>
						</div>
<?php
						}
					}
				total_pic_likes($pic_id);//количесвто лайков для данной картинки
				echo "</div>";
				if(!empty($picture['description'])){
					echo "<div class='pic-description'>";
						echo "Description:";
						echo htmlspecialchars($picture['description']);
					echo "</div>";
			}
		}else{
			echo "<p style='text-align:center;'>ERROR!<br> This picture does not exists!</p>";
		}
	}

//система лайков и анлайков для картинок
	function show_like_system($pic_id,$user_id){
		echo "<div class='like-unlike-syst'>";
		if(pic_is_liked($pic_id,$user_id)){?>
			<form action="" method="POST">
				<input type="submit" name="unlike-pic" class="unlike-pic" value='&#128148;'>
			</form>
<?php
		}else{?>
				<form action="" method="POST">
					<input type="submit" name="like-pic" class="like-pic" value='&#10084;'>
				</form>
<?php
			}
		echo "</div>";
	}

// вывод картинок в галлерею пользователя
	function show_user_pics(){
		$username = $_GET['username'];
		$id = user_id_from_username($username);
		$query = mysql_query("SELECT * FROM `gallery_pics` WHERE `user_id` = '$id' ORDER BY `id` DESC");
		$total = mysql_num_rows($query);
		while ($picture = mysql_fetch_assoc($query)){
			$pic_url = 'http://www.paskalnikita.com/images/gallery/'.$picture['pic_name'];
			echo "<div class='wrap-pic'>";
				echo "<div>";
					echo "<a href="."/gallery/pic/".$picture['id'].">";
						echo "<img height='150px' width='150px' class='round' style='margin-right:5px;' src='$pic_url'>";
					echo "</a>";
				echo "</div>";
					echo "<div class='upload-date'>";
						echo $picture['upload_date'];
					echo "</div>";
			echo "</div>";
		}
	}

//количесвто фото в галлереи
	function total_pics($user_id){
		$query = mysql_query("SELECT * FROM `gallery_pics` WHERE `user_id` = '$user_id' ORDER BY `id` DESC");
		$total = mysql_num_rows($query);
		echo 'Total pics: <b>'.$total.'</b>.';
	}

//лайкнуть фото
	function like_pic($pic_id,$user_id){
		$check = mysql_query("SELECT * FROM `pic_likes` WHERE (`user_id`='$user_id' AND `pic_id`='$pic_id')") or die(mysql_error());
		$like_prom_this_user=mysql_num_rows($check);
			if($like_prom_this_user==1){
				$query=mysql_query("UPDATE `pic_likes` SET `user_id`='$user_id', `pic_id`='$pic_id' WHERE `user_id` = '$user_id'")or die(mysql_error());
			}else{
				$query=mysql_query("INSERT INTO `pic_likes` (`user_id`,`pic_id`) VALUES ('$user_id','$pic_id')") or die(mysql_error());
			}
	}

//убрать лайк у картинки
	function unlike_pic($pic_id,$user_id){
		$query=mysql_query("DELETE FROM `pic_likes` WHERE (`user_id`='$user_id' AND `pic_id`='$pic_id')") or die(mysql_error());
	}

//лайкнута ли картинка 
	function pic_is_liked($pic_id,$user_id){
		$query=mysql_query("SELECT * FROM `pic_likes` WHERE (`user_id`='$user_id' AND `pic_id`='$pic_id')") or die(mysql_error());
		if(mysql_num_rows($query)==0){ 
			return 0;
		}else{
			return 1;
		}
	}

//подсче коичества лайков для данной картинки
function total_pic_likes($pic_id){
	$query = mysql_query("SELECT * FROM `pic_likes` WHERE `pic_id`=$pic_id");
	$total=mysql_num_rows($query);
	echo "<div class='total-pic-likes'>";
		echo $total;
	echo "</div>";
}

//удаление картинки из галлереи и бд
function delete_pic($pic_id,$username_gallery){
		$picture = mysql_query("SELECT `pic_name` FROM `gallery_pics` WHERE `id`='$pic_id'") or die(mysql_error());
		$pic_url = 'http://www.paskalnikita.com/images/gallery/'.$picture['pic_name'];
		unlink($pic_url);
		$query=mysql_query("DELETE FROM `gallery_pics` WHERE `id`='$pic_id'") or die(mysql_error());
		header ("Location: /gallery/$username_gallery");
		delete_all_pic_info($pic_id);
}

//удалить коментарий,оставленный к картинке
function delete_pic_comment($pic_comment_id){
	$delete = mysql_query("DELETE FROM `gallery_comments` WHERE `id`='$pic_comment_id'") or die(mysql_error());
	echo '<div class="success-output" style="float:left;width:240px;margin-left:20px;">Your comment has been deleted!</div>';
}

//удаляет всю информацию о картинке - комментарии лайки
function delete_all_pic_info($pic_id){
	$delete_likes=mysql_query("DELETE FROM `pic_likes` WHERE `pic_id`='$pic_id'") or die(mysql_error());
	$delete_comments=mysql_query("DELETE FROM `gallery_comments` WHERE `pic_id`='$pic_id'") or die(mysql_error());
}

// показат форму с обработчиком для загрузки фото в галлерею пользователя
	function show_upload_gallery_pic_system(){
			if(!isset($_GET['pic'])){
				if(isset($_FILES['picture'])){
					if(empty($_FILES['picture']['name'])){
						echo "<div class='img-file-error'>Please choose a file!</div>";
					}else{
						$allowed = array('jpg', 'jpeg', 'gif', 'png');
						$file_name = $_FILES['picture']['name'];
						$file_extn = strtolower(end(explode('.', $file_name)));
						$file_temp = $_FILES['picture']['tmp_name'];
						if(in_array($file_extn, $allowed) === true){
							$description = $_POST['description'];
							upload_gallery_image($session_user_id,$description,$file_temp,$file_extn);
							echo '<div class="success-output" style="float:left;width:240px;">You uploaded photo!</div>';
						}else{
							echo "<div class='img-file-error'>Incorrect file type!<br>
								Allowed types: ";
								echo implode(', ',$allowed);
							echo ".</div>";
							}
						}
				}
				echo'<img id="previewImg" class="round" width="250px" height="250px">';
		?>
		<div class="message-box" style="width:390px;float:right;top:-10px;">
			<form action='' method='post' enctype="multipart/form-data">
				<textarea placeholder="Add description" cols='5' rows='7' name='description'></textarea>
				<div style="margin-top: -26px;margin-left: 375px;">
					<input class="clear-textarea" onclick="form.reset()" value="❌" title="Clear form" type="button">
				</div>
				</div>
				<div style='float:left;'>
					<input type="file" accept="image/*" onchange="preview(this.value)" name="picture"><br>
					<input class='green-border' type="submit" value="Upload photo">
				</div>
			</form>
		</div>
	<?php
			}
		}

//вывод новостей на главную старницу
	function show_news($page){
		$num = 5;//количетсво записей на странице
		$result = mysql_query("SELECT * FROM news ORDER BY id DESC") or die(mysql_error());
		$temp = mysql_fetch_array($result);
		$posts = $temp[0];
		$total = (($posts - 1) / $num) + 1;
		$total = intval($total);
		$page = intval($page);
		if(empty($page) or $page < 0) $page = 1;
		if($page > $total) $page = $total;
		$start = $page * $num - $num;
		$get_news = mysql_query("SELECT news.*, AVG(votes.rating) AS rating
											FROM news
											LEFT JOIN votes ON news.id = votes.post_id
											GROUP BY news.id
											ORDER BY news.id
											DESC LIMIT $start, $num") or die(mysql_error());
		$news = mysql_fetch_array($get_news);
		do{?>
			<div class='post' style='margin-bottom:10px;'>
				<br>
					<p align='center'>
						<b><?php echo $news['header'];?></b>
					</p>
				<div align='left'>
					<?php echo $news["m_desc"];?>&#160;<a href='post/id/<?php echo $news["id"];?>'>More...</a>
				</div>
				<p align='left'>Rating:<b> <?php echo round($news['rating'],1);?>★/5★</b></p>
	<?php
					$post_id = $news["id"];
					$comments=mysql_query("SELECT COUNT(*) as count FROM comments WHERE post_id = '$post_id'");
					$calc_com=mysql_fetch_assoc($comments);
					$total_comments=$calc_com['count'];// подсчет комментариев для данного поста
	?>
					<div style="float:left;">Comments:
						<div class="calc-comments">
							<?php echo $total_comments;?>
						</div>
					</div>
				<p align='right'>Added:<Font color='#0000CC'><?php  echo $news["date"];?></font></p>
			</div>
	<?php
		}
		while($news = mysql_fetch_array($get_news));?>
		</div>
		<div class="pagination">
	<?php
		// проверяем, нужно ли кнопки 'назад'
			if($page != 1) $firstpage = '<a href=?page=1>«</a> | <a href=?page='. ($page - 1).'>Пред.</a> | ';
			if($page != $total) $nextpage = ' | <a href=?page='. ($page + 1) .'>След.</a> | <a href=?page=' .$total. '>»</a>';
			if($page - 3 > 0) $page3left = ' <a href=?page='. ($page - 3) .'>'. ($page - 3) .'</a> | ';
			if($page - 2 > 0) $page2left = ' <a href=?page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
			if($page - 1 > 0) $page1left = '<a href=?page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';
		// проверяем, нужно ли кнопки 'вперед'
			if($page + 3 <= $total) $page3right = ' | <a href=?page='. ($page + 3) .'>'. ($page + 3) .'</a>';
			if($page + 2 <= $total) $page2right = ' | <a href=?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
			if($page + 1 <= $total) $page1right = ' | <a href=?page='. ($page + 1) .'>'. ($page + 1) .'</a>';
			if($total > 1){
				Error_Reporting(E_ALL & ~E_NOTICE);
				$current_page = "<a href=?page=$page class='selected-page'>".$page."</a>";
				//оборажение кол-ва страниц и текущей
				echo $firstpage.$page3left.$page2left.$page1left.'<b>'.$current_page.'</b>'.$page1right.$page2right.$page3right.$nextpage;
			}
	}
// записываем пост пользователя в БД
	function add_post($post,$profile_username){
		if(!empty($post)){
			$profile_id = user_id_from_username($profile_username);
			$post = htmlspecialchars($post,ENT_QUOTES);
			$date = date('Y.m.d');
			$time = date("H:i:s");
			$query = mysql_query("INSERT INTO `blogs` (`user_id`,`post`,`date`,`time`) VALUES ('$profile_id','$post','$date','$time')") or die(mysql_error());
		}
	}
// удаление поста в блоге пользователя
	function delete_post($comment_id,$user_id){
		$result = mysql_query("SELECT * FROM blogs WHERE id = '$comment_id' ORDER BY id DESC") or die(mysql_error());
		$blogs_data = mysql_fetch_array($result);
		if($user_id === $blogs_data['user_id']){
			$record_exists = mysql_query("SELECT * FROM blogs WHERE id = '$comment_id'") or die(mysql_error());// проверяем, есть ли запись в БД
			if(mysql_num_rows($record_exists)){
				$query = mysql_query("DELETE FROM blogs WHERE id = '$comment_id'") or die(mysql_error());// удаляем запись
				echo '<div class="success-output" style="width: 634px;margin-bottom: 2px;margin-left: 3px;margin-top:2px;">You successfully deleted post!</div>';
			}else{
					echo '<div class="errors-output"style="width: 634px;margin-bottom: 2px;margin-left: 3px;margin-top:2px;">This post does not exist!</div>';
				}
		}else{
				echo '<div class="errors-output" style="width: 634px;margin-bottom: 2px;margin-left: 3px;margin-top:2px;">You can\'t delete this post!</div>';
			}
	}

// вывод формы для отправки постов в блоге польщователя
	function show_posts_form(){?>
		<div style='float:left;'>
			<form name="comment_form" action="" method="post">
			<div class="message-box" style="width:625px">
				<textarea id="comment_area" name="post" placeholder="What are you thinking about?" required></textarea>
				<div style='margin-top: -26px;margin-left: 611px;'>
					<input class="clear-textarea" type="button" onclick="form.reset()" value="&#x274c;" title="Clear form">
				</div>
			</div>
			<div class="mt9" style='float:left;'>
				<input class='submit-button' type="submit" name="submit" value="Post"/>
					Symbols left: <b><span id="counter">256</span></b>
			</div>
		</form>
		</div>
<?php
	}

// форма для коментариев
	function show_comments_form(){?>
		<div style="float: left;">
			<form name="comment_form" action="" method="POST">
				<div class="message-box">
					<textarea name="comment" rows="7" id="comment_area" cols="35" placeholder="Leave a comment" required=""></textarea>
					<div class="clear-box">
						<input class="clear-textarea" onclick="form.reset()" value="❌" type="button">
					</div>
				</div>
				<div style='float:left;margin-top: 135px;margin-left:-300px'>
					<input class="submit-button" name="submit" value="Comment" type="submit">
						Symbols left:<b><span style="color: rgb(64, 199, 129);" id="counter">255</span></b>
				</div>
			</form>
		</div>
<?php
	}

//добавление коментария к фото в галлереи
	function add_pic_comment($pic_id,$user_id,$comment){
		$date = date("d M Y");
		$query = mysql_query("INSERT INTO `gallery_comments` (`pic_id`,`user_id`,`comment`,`date`) VALUES ('$pic_id','$user_id','$comment','$date')") or die(mysql_error());
	}

//показать все коментарии к выбранной картинке
	function show_pic_comments($pic_id){
		global $user_data;
		$query=mysql_query("SELECT * FROM `gallery_comments` WHERE `pic_id`='$pic_id' ORDER BY `id` DESC") or die(mysql_error());
		while($pic_commnets = mysql_fetch_assoc($query)){
			echo "<div class='comment'>";
				echo $pic_commnets['comment'];
				echo "<br>";
					if(logged_in()){// если авторизирован
						if($user_data['user_id']===$pic_commnets['user_id']){// если Я автор комментария, вывести кноку удалить?>
							<div class='delete-post-part' style='margin-right:4px;margin-top: -30px;'>
								<form action="" method="POST">
									<input type="hidden" value="<?php echo $pic_commnets['id'];?>" name='delete-pic-comment'>
									<input type="submit" class='delete-post-link' value='&#10006;' onclick="return confirm('Are you realy want to delete this post?')">
								</form>
							</div>
		<?php			}
					}
					echo "<div style='float:right;'>";
						$username=username_from_id($pic_commnets['user_id']);
						echo "<a style='color:#0066CC;'href='/user/$username'> $username's profile</a>";
					echo "</div>";
						$date=$pic_commnets['date'];
					echo "<font size='-1'>Date:".$date."</font>";
			echo "</div>";
		}
	}

// вывести кнопки в боковом меню если администратор
	function show_admin_menu(){?>
		<li class='user-menu'>
			<a href="/mail">Mail users</a>
		</li>
		<li class='user-menu'>
			<a href="/addnews">Add news</a>
		</li>
		<li class='user-menu'>
			<a href="/admin">Admin page</a>
		</li>

<?php
}
// вывод информации о пользователе на его старнице
	function show_profile_info($profile_data){
		if(!empty($profile_data['first_name'])){?>
				<div class="user-info">First name:<?php echo $profile_data['first_name'];?>.</div>
	<?php 				}
		if(!empty($profile_data['last_name'])){?>
				<div class="user-info">Last name: <font color='#0066FF' size="+1"><?php echo $profile_data['last_name'];?>.</font></div>
	<?php 					}
		if(!empty($profile_data['birth_day'])){?>
				<div class="user-info">Birth day:
					<font color='#0066FF' size="+1">
						<?php echo $profile_data['birth_day'];?>.<?php echo $profile_data['birth_month'];?>.<?php echo $profile_data['birth_year'];?>
					</font>
				</div>
		<?php }
			if(!empty($profile_data['gender'])){?>
				<div class="user-info">Gender: <font color='#003366' size="+1"><?php echo $profile_data['gender'];?>.</font></div>
		<?php }
			if(!empty($profile_data['country'])){?>
				<div class="user-info"><div style="float:left;">Country: </div> <font color='#0033FF' size="+1"><?php echo ip_name($profile_data['ip'])."<div style='" . ip_img_style($profile_data['ip']) . "'></div>";?>.</font></div>
		<?php }
		if(!empty($profile_data['state'])){?>
				<div class="user-info">State: <font color='#3300FF' size="+1"><?php echo $profile_data['state'];?>.</font></div>
		<?php }
		if(!empty($profile_data['city'])) { ?>
				<div class="user-info">City: <font color='white' size="+1"><?php echo $profile_data['city'];?>.</font></div>
		<?php }
		if(!empty($profile_data['street'])) { ?>
				<div class="user-info">Street: <font color='white' size="+1"><?php echo $profile_data['street'];?>.</font></div>
		<?php }
		if(!empty($profile_data['house_number'])) { ?>
				<div class="user-info">House number: <font color='#3300FF' size="+1"><?php echo $profile_data['house_number'];?>.</font></div>
		<?php }
			if(!empty($profile_data['zip_code'])) { ?>
				<div class="user-info">Zip code: <font color='white' size="+1"><?php echo $profile_data['zip_code'];?>.</font></div>
		<?php }
	}
// показать посты пользователя в его блоге
	function show_profile_posts($blog_id,$user_id,$profile_id){
		$blog_posts = mysql_query("SELECT * FROM `blogs` WHERE `user_id` = '$blog_id' GROUP BY `id` DESC");
		while($posts = mysql_fetch_array($blog_posts)){// выводим записи блога
			echo "<div class='post'>";
				echo $posts['post'];
				echo "<br>";
					if(logged_in()){// если авторизирован
						if($user_id === $profile_id){// если Я автор комментария, вывести кноку удалить?>
							<div class='delete-post-part' style='margin-right:4px;margin-top: -30px;'>
								<form action="" method="POST">
									<input type="hidden" value="<?php echo $posts['id'];?>" name='post-delete'>
									<input type="submit" class='delete-post-link' value='&#10006;' onclick="return confirm('Are you realy want to delete this post?')">
								</form>
							</div>
		<?php			}
					}
					$time=$posts['time'];
				echo "<div title='Time: $time'>";
					echo $posts['date'];
				echo "</div>";
			echo "</div>";
		}
	}
// вывод списка пользователей
	function show_users_list($sort_type){
		$query = mysql_query("SELECT * FROM users WHERE active = 1 ORDER by $sort_type");
		$user_data = mysql_fetch_array($query);
			do{?>
					<div class="users-list">
						<img style='float:left;margin:5px 5px;' src="<?php echo $user_data['profile'];?>" class='round' height='50px' alt="<?php echo $user_data['username'];?>'s photo">
							<li>
								First name: <?php echo $user_data['first_name'];?>.
							</li>
							<li>
								First name: <?php echo $user_data['last_name'];?>.
							</li>
								<li>
									<a href="/user/<?php echo $user_data['username']; ?>"><?php echo $user_data['username']; ?>'s profile</a>
								</li>
					</div>
			<?php }
			while ($user_data = mysql_fetch_array($query));
	}

//удаляем коментарий к посту
	function delete_comment($comment_id,$username_name){
		$result = mysql_query("SELECT * FROM comments WHERE id = '$comment_id' AND post_id = '$post_id' ORDER BY id DESC") or die(mysql_error());
		$comments_data = mysql_fetch_array($result);
		if($user_data['username'] === $comments_data['username']){
			$record_exists = mysql_query("SELECT * FROM comments WHERE id = '$comment_id'") or die(mysql_error());// проверяем, есть ли запись в БД
			if(mysql_num_rows($record_exists)){
				$query = mysql_query("DELETE FROM comments WHERE id = '$comment_id'") or die(mysql_error());// удаляем запись
				echo '<div class="success-output" style="width: 305px;margin-bottom: 2px;margin-left: 3px;">You successfully deleted post!</div>';
			}else{
					echo '<div class="errors-output"style="width: 305px;margin-bottom: 2px;margin-left: 3px;">This post does not exist!</div>';
				}
		}else{
				echo '<div class="errors-output" style="width: 305px;margin-bottom: 2px;margin-left: 3px;">You can\'t delete this post!</div>';
			}
	}
?>