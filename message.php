<?php
	include 'core/init.php';
	protect_page();// тоько для авторизированных пользователей
	if(!empty($_GET['to'])){
		$to_user = $_GET['to'];
		$temp = mysql_query("SELECT COUNT(*) FROM `users` WHERE `user_id` = '$to_user'");
		if(mysql_result($temp, 0) > 0){
			$username = username_from_id($to_user);// получаем username
		}
		$title ="Dialog with $username";// показываем с кем диалог
	}else{
		$title ="Messages";
	}
	include 'includes/overall/header.php';?>
<h1>Sending messages</h1>
<div id="content">
<?php
	if(empty($_GET['to'])){
		echo "Please select message-user!";
		$my_id = $user_data['user_id'];
		echo '<br>Last messages: <br>';
		echo "<hr>";
		$dialogs = mysql_query("SELECT *,COUNT(id) as count FROM `messages`
													WHERE `from` = '$my_id' OR `to` = '$my_id'
													GROUP BY `to`,`from`")or die(mysql_error());
		$array = array();
		while($row = mysql_fetch_assoc($dialogs)){// вывод всех собеседников
				$my_id = $user_data['user_id'];
				if($my_id === $row['to'])$array[] = $row['from'];// проверка на собеседника, чтобы не было диалого с самим собой
				if($my_id != $row['to'])$array[] = $row['to'];// проверка на собеседника, чтобы не было диалого с самим собой
			}
		$users_id = array_unique($array);
		sort($users_id);// сортируем по id пользователя
		for($i=0; $i<count($users_id); $i++){?>
			<div class='message' style="padding:5px;">
				<a href='?to=<?php echo $users_id[$i];?>' style='text-decoration:none;'>
					Dialog with <?php echo username_from_id($users_id[$i]);?>
				</a>
<?php
					$to_id = $users_id[$i];//выбор id собеседников
					$select_messages=mysql_query("SELECT COUNT(id) AS count FROM `messages` WHERE (`to`=$to_id and `from` = $my_id) OR (`from`=$to_id and `to` = $my_id)");
					$unread_messages=mysql_query("SELECT COUNT(id) AS unread FROM `messages` WHERE `to`=$my_id and `from` = $to_id AND `unread`='1' ");
					$calc_messages = mysql_fetch_assoc($select_messages);
					$calc_unread = mysql_fetch_assoc($unread_messages);
					if(!empty($calc_unread['unread'])){//есть ли новые сообщения
						echo "<div style='float:right;' class='calc-messages'>";
							// echo $calc_messages['count']; //вывод кол-ва сообщений
							echo '+'.$calc_unread['unread']; //вывродим новые непрочитанные сообщения, количество
						echo "</div>";
						}
					?>
			</div>
<?php
		}
	}
	if(isset($_POST['send_message'])){// если нажали отправить сообщение
		if(!empty($_POST['message'])){// если сообщение не пустое
			$message = $_POST['message'];
			$to = $_POST['to'];
			$from = $user_data['user_id'];
			add_message($from,$to,$message);
		}
	}
	if(!empty($_GET['to'])){// если выбрали собеседника
		if(!empty($username)){
			$from = $user_data['user_id'];// от кого - от меня
			$to = $_GET['to'];// кому - собеседнику
			$select_messages=mysql_query("SELECT COUNT(id) AS count FROM `messages` WHERE (`to`=$to and `from` = $my_id) OR (`from`=$to and `to` = $my_id)");
			$calc_messages = mysql_fetch_assoc($select_messages);
			echo "<div style='float:right;'>";
				echo "Total messages:";
				echo $calc_messages['count']; //вывод кол-ва сообщений
			echo "</div>";
			echo "Dialog with <a href='user/$username'>$username</a>:";// показываем с кем диалог
			$query = mysql_query("SELECT * FROM `messages` WHERE `from` = $from AND `to` = $to OR `from` = $to AND `to` = $from ORDER BY `id` DESC") or die(mysql_error());
			$messages = mysql_fetch_array($query);
			$read_message = mysql_query("UPDATE `messages` SET `unread`='0' WHERE `to`='$from' and `from` = '$to'") or die(mysql_error());//`прочитываем` сообщение
			?>
			<div class="messages-box">
<?php
				if(!empty($messages)){// выодим сообщения
					do{
						$from_username_id = $messages['from'];
						$from_username = username_from_id($from_username_id);// получаем никнейм из id
						echo "<div class='message'>";
							echo "<div class='right'>";
								echo $messages['date'];
							echo '</div>';
						echo "<a href='user/$from_username'>";// сслыка на собеседника
							echo $from_username;// сслыка на собеседника
						echo '</a>:<br>';// сслыка на собеседника
						echo $messages['message'];
							echo "<div class='right'>";
								echo $messages['time'];
							echo "</div>";
						echo "</div>";
					}while($messages = mysql_fetch_array($query));
				}else{
						echo "Dialog is empty!";// если нет ообщений
					}?>
			</div>
				<form action="" method="POST"> <!-- форма для отправки сообщений-->
					<div align='center'>
						<textarea spellcheck="false" name="message" id="" cols="45" rows="7"></textarea>
					</div>
					<input type="hidden" name="to" value="<? echo $_GET['to'];?>"><!-- опрделяеям, кому отправляем сообщение-->
					<input type="Submit" name="send_message" value="Send">
				</form>
<?php
		}else{
				echo 'This user does not exists!';// если id обеседника непрвильный
			}
	}
	echo '</div>';
include'includes/overall/footer.php';?>