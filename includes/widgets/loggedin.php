				<div class="widget">
					<h2>
						<script language="JavaScript">
							var h=(new Date()).getHours();
							if (h >= 3 && h < 12) document.writeln("Good morning,");
							if (h >= 12 && h < 18) document.writeln("Good afternoon,");
							if (h >= 18 && h < 23) document. writeln("Good evening,");
							if (h >= 23 || h < 3) document.writeln("Good night,");
						</script>
						<?php echo $user_data['first_name'];?>!
					</h2>
						<div class="profile">
<?php
								if(!empty($user_data['profile'])){
									echo '<img class="round" width="100%" src="/', $user_data['profile'], '" alt="',$user_data['first_name'],'\'s profile image">';
								}?>
						<ul>
							<a class='white-link' href="/user/<?php echo $user_data['username']; ?>">
								<li class='user-menu'>
									Profile
								</li>
							</a>
							<a class='white-link' href="/message">
								<li class='user-menu' style='min-width:70px;'>
									Messages
								</li>
							</a>
								<a class='white-link' href="/gallery/<?php echo $user_data['username'];?>">
									<li class='user-menu' style='min-width:70px;'>Photos
									</li>
								</a>
<?php
							$my_id = $user_data['user_id'];
							$unread_messages=mysql_query("SELECT COUNT(id) AS unread FROM `messages` WHERE `to`=$my_id AND `unread`='1' ");
							$calc_unread = mysql_fetch_assoc($unread_messages);
							if(!empty($calc_unread['unread'])){//есть ли новые сообщения
								echo "<div style='float:left;margin-top:-70px;margin-left:75px;' class='calc-messages'>";
									echo '+'.$calc_unread['unread']; //вывродим новые непрочитанные сообщения, количество
								echo "</div>";
							}?>
							<a class='white-link' href="/settings">
								<li class='user-menu'>
									Settings
								</li>
							</a>
<?php						// если зашел администратор показать дополнительные пункты меню
							if(is_admin($user_data['user_id'])){
								show_admin_menu();
							}?>
							<a class='white-link' href="/logout">
								<li class='user-menu'>
									Log out
								</li>
							</a>
						</ul>
						</div>
				</div>