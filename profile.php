<?php
	include 'core/init.php';
		if(isset($_GET['username']) && !empty($_GET['username'])){// если выбрана страницa с пользователем
			$username			= $_GET['username'];
			if(user_exists($username)){// если есть такой пользователь выводим массив
				$user_id			= user_id_from_username($username);
				$profile_data	= user_data($user_id, 'username', 'user_id',
													'first_name','last_name','email',
													'password_recover','profile','country',
													'state','city','street','house_number',
													'birth_day','birth_month','birth_year',
													'zip_code','gender','active','ip');// какие значения передаются в массив
				$title = $profile_data['username'];
				include 'includes/overall/header.php';
				$my_id=$user_data['user_id'];
				$new_friend_request = mysql_query("SELECT * FROM `friends` WHERE `user_one`='$my_id' AND `type`='2'") or die(mysql_error());//меня добавляют в друзья
				$new_friend_info = mysql_fetch_assoc($new_friend_request);
					$new_friend_id=$new_friend_info['user_two'];
					$new_friend_username=username_from_id($new_friend_id);
				//подтвеждение что друзья
				if(!empty($_POST['confirm_friend'])){
					$user_two = user_id_from_username($new_friend_username);
					$query=mysql_query("UPDATE `friends` SET type = '1' WHERE `user_one`='$my_id' AND `user_two`='$user_two' OR `user_one`='$user_two' AND `user_two`='$my_id'") or die(mysql_error());
					echo "<div class='vanishing'>";
						echo "<a style='text-decoration:none;' href='$new_friend_username'>$new_friend_username</a> added as a friend!<br>";
					echo "</div>";
				}
				//отклоняю что друзья
				if(!empty($_POST['ignore_friend'])){
					$user_two = user_id_from_username($new_friend_username);
					$query=mysql_query("UPDATE `friends` SET type = '0' WHERE `user_one`='$my_id' AND `user_two`='$user_two' OR `user_one`='$user_two' AND `user_two`='$my_id'") or die(mysql_error());
					echo "<div class='vanishing'>";
						echo "<a href='$new_friend_username'>$new_friend_username</a> ignored!";
					echo "</div>";
				}
				//запрос на добавение в друзья
				if(!empty($_POST['add_friend'])){
					$user_one = $profile_data['user_id'];
					$user_two = $user_data['user_id'];
					$add_friend = mysql_query("INSERT INTO friends (`user_one`,`user_two`,`type`) VALUES ('$user_one','$user_two','2')") or die(mysql_error());
				}
				//проверка на друзей
				$new_friend_request = mysql_query("SELECT * FROM `friends` WHERE `user_one`='$my_id' AND `type`='2'") or die(mysql_error());//меня добавляют в друзья
				$new_friend_info = mysql_fetch_assoc($new_friend_request);
					$new_friend_id=$new_friend_info['user_two'];
					$new_friend_username=username_from_id($new_friend_id);
					if($user_data['user_id'] == $profile_data['user_id']){
						if(!empty($new_friend_username)){
							echo "<a style='text-decoration:none;'href='/user/$new_friend_username'>$new_friend_username</a> want to add you ass a friend!";?>
								<form action="" method="POST">
									<input type="submit" class='add-friend-button' value="Add" name="confirm_friend">
									<input type="submit" class='ignore-friend-button' value='Ignore' name="ignore_friend">
								</form>
							<?php
						}
					}
				?>
		<div style='float:right;'>
<?php
				// определяем онлайн ли пользователь
				getOnline($profile_data['user_id']);?>
		</div>
				<h1><?php echo $profile_data['first_name'];?>'s profile.</h1>
				<div class="left">
					<div class="left-profile-info">
					<?php if(logged_in()){
								if($user_data['user_id'] != $profile_data['user_id']){
									$profile_id=$profile_data['user_id'];
									$i_send_friend_request = mysql_query("SELECT * FROM `friends` WHERE `user_two`='$my_id' AND `user_one`='$profile_id' AND `type`='2'") or die(mysql_error());//я отправил запрос на добавление в друзья
									$sended_request= mysql_fetch_assoc($i_send_friend_request);
										$request_from_me=$sended_request['user_one'];
										if(!empty($request_from_me)){?>
												You send friend request!
												<br><br>
<?php
										}else{//если запрос не от меня
											$user_two = $profile_data['user_id'];
											$already_friends =  mysql_query("SELECT * FROM `friends` WHERE (`user_one`='$my_id' AND `user_two`='$user_two' AND `type`='1') OR (`user_one`='$user_two' AND `user_two`='$my_id' AND `type`='1')") or die(mysql_error());//я отправил запрос на добавление в друзья
											$we_are_friends= mysql_fetch_assoc($already_friends);
											if($we_are_friends){?>
												<div class="already-friends-block">
													Friends
												</div>
<?php
								}
										$friend_request_from_user = mysql_query("SELECT * FROM `friends` WHERE `user_two`='$profile_id' AND `user_one`='$my_id' AND `type`='2'") or die(mysql_error());
										$sended_request= mysql_fetch_assoc($friend_request_from_user);
										$request_from_this_user=$sended_request['user_one'];
											if(!empty($request_from_this_user)){?>
													Friend request from this user!
												<br><br>
<?php
										}
								if(!$we_are_friends && empty($request_from_this_user)){//если не друзья показать кнопку добавить в друзья
?>
										<div class="add-friend-block">
											<form action="" method='post'>
												<input type="submit" name='add_friend' value="+" class="add-friend">
											</form>
										</div>
<?php
									}
								}
									echo '<img src="/', $profile_data['profile'],'" width="250px" style="margin-top:-22px;"class="round" alt=" ',$profile_data['first_name'], '\'s profile image">';
								}else{
									echo '<img src="/', $profile_data['profile'], '" width="250px" class="round" alt=" ',$profile_data['first_name'], '\'s profile image">';
									}
							}else{
									echo '<img src="/', $profile_data['profile'], '" width="250px"  class="round" alt=" ',$profile_data['first_name'], '\'s profile image">';
								}
						// если авторизированы вывести блоки с фото и сообщениями
						if(logged_in()){?>
							<div>
								<a href="/gallery/<?php echo $profile_data['username'];?>">
									<div class='green-button' style="float:left;">
										Photos
									</div>
								</a>
								<?php if($profile_data['user_id'] === $user_data['user_id']){?>
									<a href="/message">
										<div class='green-button' style="float:right;margin-left:5px;">
											Messages
										</div>
									</a>
<?php					}else{				?>
								<a href="/message/to/<?php echo $profile_data['user_id'];?>">
									<div class='green-button' style="float:right;margin-left:5px;">
										Message
									</div>
								</a>
<?php					}
					echo "</div>";
					$profile_id=$profile_data['user_id'];
						$query=mysql_query("SELECT * FROM `friends` WHERE (`user_one`='$profile_id' OR `user_two`='$profile_id') AND `type`=1") or die(mysql_error());
							$number_of_friends=mysql_num_rows($query);
							if($query){
								echo "<div class='friends-list'>";
								echo "<a href='/user/".$profile_data['username']."&friends'>";
									echo "Number of friends:".$number_of_friends.".";
								echo "</a>";
								echo "</div>";
							}
						}
						if(!logged_in()){?>
							<div>
								<div class='not-loggedin-info'>
									For sending messages and whatching photos, please, log in.
								</div>
							</div>
<?php					}?>
					</div>
					<div class="right-profile-info">
<?php
							if(isset($_GET['friends']) && logged_in()){// если есть &friends вывести список друзей
								$profile_username = $profile_data['username'];
								echo "<a href='/user/$profile_username'>&#x2190;Show profile info</a><span style='padding-left:20px;'></span>Friends list:";
								while($friends_info=mysql_fetch_assoc($query)){
									if($friends_info['user_one']!=$my_id){
										$friend_username=username_from_id($friends_info['user_one']);
									}else{
										$friend_username=username_from_id($friends_info['user_two']);
									}
										echo "<div class='friends-list-element'>";
											echo "<a href='/user/$friend_username' >".$friend_username.'</a>';
										echo "</div>";
								}
							}else{
								show_profile_info($profile_data);
							}
	?>
					</div>
					<div class="clear"></div>
						<div class="blog-header">
							<b><?php echo $profile_data['first_name'];?>'s blog:</b>
						</div>
<?php
							//если написали пост в блоге, записываем его в БД
								if(!empty($_POST['post'])){
									$post = $_POST['post'];
									$profile_username = $profile_data['username'];
									add_post($post,$profile_username);
								}
							// если нажал удалить пост
								if(!empty($_POST['post-delete'])){
									$comment_id = $_POST['post-delete'];
									$user_id = $user_data['user_id'];
									delete_post($comment_id,$user_id);
								}
						//выводим посты для блога
								$blog_id = $profile_data['user_id'];
								$user_id = $user_data['user_id'];
								if(isset($_GET['page'])) {
									$page = $_GET['page'];
								}else{
									$page=1;
								}
								show_profile_posts($blog_id,$user_id,$page);
							if(!empty($user_data['username'])){
								// если это моя страница, выводим форму для постов
								if($profile_data['username'] === $user_data['username']){
									show_posts_form();
								}
							}
			}else{// если такого пользователя нет
					$title ='Error';
					include 'includes/overall/header.php';
					echo "
						<h1>
							Error
						</h1>
					<p>Sorry, this user does not exists!</p>";
				}
		}else{
				header('Location: index');
				exit();
			}
	include 'includes/overall/footer.php';
?>