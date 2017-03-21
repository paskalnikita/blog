<?php
	include 'core/init.php';
	$id = (int)$_GET['id'];// получаем id поста
	if(!empty($user_data['user_id'])) {
		$user_id = $user_data['user_id'];
		$votes_select = mysql_query("SELECT * FROM votes WHERE post_id =$id AND user_id = $user_id");
		$votes = mysql_fetch_assoc($votes_select);
	}
	if($votes['user_id'] === $user_data['user_id']){// если уже голосовали, делаем редирект
		header('Location: post/id/'.$id);
	}else{
			if(isset($_GET['id'], $_GET['rating'])){// если не голосовали записываем в БД
				$user_id=$user_data['user_id'];
				$id = (int)$_GET['id'];
				$rating = (int)$_GET['rating'];
				if(in_array($rating, array(1,2,3,4,5))) {
					$exists = mysql_query("SELECT id FROM news WHERE id = {$id}") ? true : false;
					if($exists){
						$rate = mysql_query("INSERT INTO votes (post_id,rating,user_id) VALUES ({$id}, {$rating}, {$user_id})");
					}
				}
				header('Location: post/id/'.$id);//редирект после голосования
			}
		}
	if(empty($id)){// если id поста пустой редирект на первый пост
		$id = 1;
		header('Location: post/id/'.$id);
	}
?>