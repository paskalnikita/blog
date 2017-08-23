<?php
	include 'core/init.php';
	if(!isset($_GET["id"])){// проверка на правильный id статьи
		$id = 1;
	}else{
		$id=$_GET["id"];// проверка на правильный id статьи
		}
	if($id<=0){// проверка на правильный id статьи
		$id = 1;
	}
	$select_id = mysql_query("SELECT MAX(`id`) AS 'max' FROM news")or die(mysql_error());
	$get_max_id = mysql_fetch_assoc($select_id);
	$max_id = $get_max_id['max'];
	if($id>$max_id){// проверка на правильный id статьи
		$id = $max_id;
	}
	$post_id = $id;// получаем id статьи
	$get_news = mysql_query("SELECT news.*, AVG(votes.rating) AS rating
					FROM news
					LEFT JOIN votes
					ON news.id = votes.post_id
					WHERE news.id = {$id}
					")or die(mysql_error());
	$news = mysql_fetch_array($get_news);
	$title = $news['title'];
	include 'includes/overall/header.php';
	//выводим статьи
do{?>
			<div id="content">
				<p align='center'><?php echo $news['header'];?></p>
				<div id="content">
					<div class='post' style="float:left;">
						<p align='center'>
							<b><?php echo $news['header'];?></b>
						</p>
<?php
				// разрешиь редактирование статьи если администратор
					if(is_admin($user_data['user_id'])){?>
						<div title='Edit' style='float: right;cursor:pointer;font-size:25pt;margin-top: -53px;color:#C400AB;'>
							&#9997;
						</div>
				<?php
									}
			 echo $news['desc'];?>
						<br>
							Rating: <b><?= round($news['rating'],1);?>★/5★</b>
<?php
							$ratings=mysql_query("SELECT COUNT(*) as count FROM votes WHERE post_id = '$post_id'");
							$calc_rates=mysql_fetch_assoc($ratings);
							$total_rates=$calc_rates['count'];
							echo "<br>";
							echo 'Rates:'.$total_rates;// сколько раз оценили статью
							if(logged_in()){// если авторизирвоан, вывести ссылки на оценку
								$user_id = $user_data['user_id'];
								$votes_select = mysql_query("SELECT user_id FROM votes WHERE post_id =$id AND user_id = $user_id") or die(mysql_error());
								$votes = mysql_fetch_assoc($votes_select);
								if($votes['user_id'] === $user_data['user_id']){// если голосовал
									echo '<div id="already-voted">';
										echo "You already voted!";
									echo '</div>';
								}else{// если НЕ голосовал
										foreach(range(1,5) as $rating):?>
												<a href="/rate?id=<?php echo $news['id'];?>&rating=<?php echo $rating;?>" style='text-decoration:none;'onclick="return confirm('Do you realy want rate <?php echo $rating;?> for this post?')">
													<div class="rating-link">
														<?php echo $rating;?>
													</div>
												</a>
										<?php endforeach;
									}
							}
						?>
						<p align='right' class='p3'>Added:<Font color='#06C'><?php echo $news['date'];?></font></p>
					</div>
				</div>
<?php			}
				while($news = mysql_fetch_array($get_news));
					if(!empty($_POST['post-delete'])){// если нажал удалить комментарий
						$comment_id = $_POST['post-delete'];
						$username_name = $user_data['username'];
						delete_comment($comment_id,$username_name);
					}
						$comment = trim(filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING));// убираем лишние символы
						if(!empty($comment)){// если комментарий не пустой
							$username = $user_data['username'];
							add_comment($username,$comment);
							if(add_comment($username,$comment)){
								echo "<div class='success-output'>Your comment has been added!</div>";
							}else{
									echo "<div class='errors-output' style=\"width: 305px;margin-bottom: 2px;margin-left: 3px;\">Can't add a comment!</div>";
								}
						}
	//если Вы администратор адалите пост
		if(!empty($_POST['admin-post-delete'])){
			$comment_id = $_POST['admin-post-delete'];
			$record_exists = mysql_query("SELECT * FROM comments WHERE id = '$comment_id'") or die(mysql_error());
			if(mysql_num_rows($record_exists)){
				$admin_comm_del = '<font color="#FF4040"><b>This post was deleted by administrator!</b></font>';
				$query = mysql_query("UPDATE comments SET comment = '$admin_comm_del' WHERE id = '$comment_id'") or die(mysql_error());
				echo '<div class="success-output" style="width: 305px;margin-bottom: 2px;margin-left: 3px;">You changed post!</div>';
			}
		}
		// если авторизирован, вывести форму для комментариев
					if(logged_in()){
							show_comments_form();
					}else{// если не авторизирован
							echo'<div class="cannotcomment">You need to be logged in for leaving comments!</div>';
						}?>
	<div class="comments" style="float:left;">
		Commnets:
<?php
				$post_id = $id;
				$comments=mysql_query("SELECT COUNT(*) as count FROM comments WHERE post_id = '$post_id'");
				$calc_com=mysql_fetch_assoc($comments);
				$total_comments=$calc_com['count'];// кол-во коментариев для данного поста
				?>
				<div style="float:right;">
					<div class="calc-comments">
						<?php echo $total_comments;?>
					</div>
				</div>
	</div>
<?php
		$result = mysql_query("SELECT * FROM comments WHERE post_id='$post_id' ORDER BY id DESC") or die(mysql_error());
		$smile = array(":)", ":-|", "8-P", ":-(");// самлики, которые надо поменять
		$grafic = array("<img src='/smile.png' alt=':)'>",// на какие смайлики менять
		"<img src='smail/dumbfounded.png' alt='Грустный' align='middle'>",// на что менять
		"<img src='smail/crazy.png' alt='Класно' align='middle'>",// на что менять
		"<img src='smail/evil.png' alt='Недоволен' align='middle'>");// на что менять
	while($myrow = mysql_fetch_array($result)):?>
	<div class="comment">
<?php
					if(!empty($user_data['username'])){// если авторизирован
						if($user_data['username'] === $myrow['username']){// если Я автор комментария, вывести кноку удалить?>
							<div class='delete-post-part'>
								<form action="" method="POST">
									<input type="hidden" value='<?php echo $myrow['id'];?>' name='post-delete'>
									<input type="submit" class='delete-post-link' value='&#10006;' onclick="return confirm('Are you realy want to delete this comment?')">
								</form>
							</div>
<?php					}
					}
			echo make_links(make_tags($myrow["comment"]));?>
		<br>
			<font size='-1' title="Time:<?php echo $myrow['time'];?>" style='cursor:help;'>Date:<?php echo $myrow['date'];?></font>
			<div style='float:right;'>
				<a style="color:#0066CC;" href="/user/<?php echo $myrow['username']; ?>"> <?php echo $myrow['username'];?>'s profile</a>
				<?php
	//если Вы администратор вывести флажки с удалением
		if(is_admin($user_data['user_id'])){?>
				<div style='float:left;margin-right:3px;'>
					<form action="" method="POST">
						<input type="hidden" value='<?php echo $myrow['id'];?>' name='admin-post-delete'>
						<input type="submit" class='admin-delete-post' value='&#9873;' onclick="return confirm('You will delete post of this user. Are you sure?')">
					</form>
				</div>
<?php		}
?>
			</div>
	</div>
<?php endwhile;
// создаем файл для статитстики 'кто на странице'
		$filename ="post_$post_id.txt";
		$file_dir = "sessions/$filename";
		$base = "sessions/$filename";
		if(file_exists($file_dir)){
			session_start();
			//выделяем уникальный идентификатор сессии
			$session_id = session_id();
			if($session_id!=""){
				//текущее время
				$CurrentTime = time();
				//через какое время сессии удаляются
				$LastTime = time() - 300;
				//файл, в котором храним идентификаторы и время
				$base = "sessions/$filename";
				$file = file($base);
				$k = 0;
				for($i = 0; $i < sizeof($file); $i++){
					$line = explode("|", $file[$i]);
					if($line[1] > $LastTime){
						$ResFile[$k] = $file[$i];
						$k++;
					}
				}
				for($i = 0; $i<sizeof($ResFile); $i++){
					$line = explode("|", $ResFile[$i]);
					if($line[0]==$session_id){
						$line[1] = trim($CurrentTime)."\n";
						$is_sid_in_file = 1;
					}
					$line = implode("|", $line); $ResFile[$i] = $line;
				}
				$fp = fopen($base, "w");
				for($i = 0; $i<sizeof($ResFile); $i++){
					fputs($fp, $ResFile[$i]);
				}
				fclose($fp);
				if(!$is_sid_in_file){
					$fp = fopen($base, "a-");
					$line = $session_id."|".$CurrentTime."\n";
					fputs($fp, $line);
					fclose($fp);
				}
			}
		}else{
			$fh = fopen ("sessions/$filename", "w+");
			fwrite($fh, "");
			fclose($fh);
			}
	echo '<div style="float:right;">';
		echo "Users on page: <div class='users-at-page'>".sizeof(file($base))."</div>";
	echo "</div> ";
	include 'includes/overall/footer.php';
?>