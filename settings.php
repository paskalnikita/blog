<?php
	include 'core/init.php';
	protect_page();
	$title = 'Settings';
	include 'includes/overall/header.php';
	if(empty($_POST) === false){
		$required_fields = array('first_name', 'email');// поля, которые обязательно не должный быть путыми
		foreach($_POST as $key => $value){
			if(empty($value) && in_array($key, $required_fields) === true){
				$errors[] = 'Fields empty!';
				break 1;
			}
		}
		if(empty($errors) === true){
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
				$errors[] = 'A valid email adress is requared';
			}else if(email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']){
				$errors[] = 'Sorry, the email \'' .$_POST['email'] . '\' is already in use';
			}
		}
	}
	?>
	<h1>Settings</h1>
<div class="left-settings">
<?php
// выбор дня рождния и оформление по правилам месяца
	$dayOptions = '<option value="0" id="day_option">Day:</option>';
	if(!empty($user_data['birth_day'])){
		for($day=1; $day<=31; $day++){
			$selected = ($user_data['birth_day']==$day)?'selected':'';
			$dayOptions .= "<option ".$selected." value=\"".$day."\">".$day."</option>\n";
		}
	}else{
			$dayOptions = '<option value="0" id="day_option">Day:</option>';
			for($day=1; $day<=31; $day++){
				$dayOptions .= "<option value=\"{$day}\">{$day}</option>\n";
			}
		}
// выбор месяцы рождния и оформление по правилам месяца
	$monthOptions = '<option value="0" id="month_option">Month:</option>';
	if(!empty($user_data['birth_month'])){
		for($month=1; $month<=12; $month++){
			$monthName = date("M", mktime(0, 0, 0, $month));
			$selected = ($user_data['birth_month']==$month)?'selected':'';
			$monthOptions .= "<option ".$selected." value=\"".$month."\">".$monthName."</option>\n";
		}
	}else{
		for($month=1; $month<=12; $month++){
			$monthName = date("M", mktime(0, 0, 0, $month));
			$monthOptions .= "<option value=\"{$month}\">{$monthName}</option>\n";
		}
	}
// выбор года рождения
	$yearOptions = '<option value="0" id="year_option">Year:</option>';
	if(!empty($user_data['birth_year'])){
		for($year=2015; $year>=1890; $year--){
			$selected = ($user_data['birth_year']==$year)?'selected':'';
			$yearOptions .= "<option ".$selected." value=\"".$year."\">".$year."</option>\n";
		}
	}else{
			$yearOptions = '<option value="0" id="year_option">Year:</option>';
				for($year=2015; $year>=1890; $year--){
					$yearOptions .= "<option value=\"{$year}\">{$year}</option>\n";
				}
		}
	if(isset($_POST['first_name'])){
	if(!preg_match("/^([a-z]|[A-Z])+$/", $_POST['first_name'])){
		$errors[] = "Your first name contains invalid characters!";
	}
	if(!preg_match("/^([a-z]|[A-Z])+$/", $_POST['last_name'])){
		$errors[] = "Your last name contains invalid characters!";
	}
	if(!preg_match("/^([a-z]|[A-Z])+$/", $_POST['country'])){
		$errors[] = "Your country contains invalid characters!";
	}
	// if(!preg_match("/^([a-z]|[A-Z])+$/", $_POST['state'])){
	// 	$errors[] = "Your state contains invalid characters!";
	// }
	if(preg_match("/\\s/", $_POST['zip_code'])){
		$errors[] = 'Your zip code must not contain any spaces!';
	}
	if(empty($_POST['day'])){
		$errors[] = 'You did\'t select day of birth!';
	}
	if(empty($_POST['month'])){
		$errors[] = 'You did\'t select month of birth!';
	}
	if(empty($_POST['year'])){
		$errors[] = 'You did\'t select year of birth!';
	}
	if(empty($errors) === TRUE){
		$update_data = array(
			'first_name'	=> $_POST['first_name'],
			'last_name'		=> $_POST['last_name'],
			'email'			=> $_POST['email'],
			'country'		=> $_POST['country'],
			'state'			=> $_POST['state'],
			'city'			=> $_POST['city'],
			'street'			=> $_POST['street'],
			'house_number'	=> $_POST['house_number'],
			'zip_code'		=> $_POST['zip_code'],
			'allow_email'	=> ($_POST['allow_email'] == 'on') ? 1 : 0,
			'birth_day'		=> $_POST['day'],
			'birth_month'	=> $_POST['month'],
			'birth_year'	=> $_POST['year'],
			'gender'			=> $_POST['gender']);// что отправляем для обновления
		update_user($session_user_id, $update_data);// обновление информации о пользователе
		$_SESSION['update'] = 'success';// сессия для вывода блока об обновлении информаиции
		header('Location: settings');
		exit();
	}
	else{
		echo '<div  style="width:280px;"class="errors-output">';
			echo output_errors($errors);
		echo '</div>';
	}
}
if($_SESSION['update'] == 'success'){// вывод блока об обновлении информации
		echo '<div class="success-output" style="width:240px;">';
			echo "Your information has been updated!";
		echo '</div>';
		$_SESSION['update'] = 'failure';
}
			if($user_data['gender']  == 'female'){// проверка на пол
				$checked_female = 'checked';
				$checked_male = '';
			}else{
					$checked_female = '';
					$checked_male = 'checked';
				}
?>
	<form action="" method="post">
		<ul>
			<li>
				First name:<br/>
				<input type="text" name="first_name" value="<?php echo $user_data['first_name'];?>">
			</li>
			<li>
				Last name:<br/>
				<input type="text" name="last_name" value="<?php echo $user_data['last_name'];?>">
			</li>
			<li>
				Email:<br/>
				<input type="text" name="email" value="<?php echo $user_data['email'];?>">
			</li>
			<div class="tree-settings"><font size="+1">Adress:</font>
				<!-- <details> -->
					<div>
						<li class="no">
							<input style="width:170px;" type="text" name="country" placeholder="Country" value="<?php if(!empty($user_data['country'])) echo $user_data['country'];?>">
						</li>
							<br>
					</div>
					<div>
						<li class="no">
							<input style="width:170px;" type="text" name="state" placeholder="State(if nessesory)" value="<?php if(!empty($user_data['state'])) echo $user_data['state'];?>">
						</li>
						<br>
					</div>
					<div>
						<li class="no">
							<input style="width:170px;" type="text" name="city" placeholder="City" value="<?php if(!empty($user_data['city'])) echo $user_data['city'];?>">
						</li>
							<br>
					</div>
					<div>
						<li class="no">
							<input style="width:170px;" type="text" name="street" placeholder="Street" value="<?php if(!empty($user_data['street'])) echo $user_data['street'];?>">
						</li>
							<br>
					</div>
					<div>
						<li class="no">
							<input style="width:173px;" type="text" name="house_number" placeholder="House number" value="<?php if(!empty($user_data['house_number'])) echo $user_data['house_number'];?>">
						</li>
							<br>
					</div>
				<!-- </details> -->
			</div>
			<li>
				<input type="text" name="zip_code" placeholder="Zip code" value="<?php if(!empty($user_data['zip-code'])) echo $user_data['zip_code'];?>">
			</li>
			<li>
				Gender:<br/>
				<input type="radio" name="gender" value="female"<?php echo $checked_female;?>>Female
				<input type="radio" name="gender" value="male"<?php echo $checked_male;?>>Male
			</li>
			<li>
				Date of birth:<br>
				<select name="day" id="day">
					<?php echo $dayOptions;?>
				</select>
				<select name="month" id="month" onchange="updateDays();">
					<?php echo $monthOptions;?>
				</select>
				<select name="year" id="year" onchange="updateDays();">
					<?php echo $yearOptions;?>
				</select>
			</li>
			<li>
				<input type="checkbox" name="allow_email" <?php if($user_data['allow_email'] == 1){echo "checked='checked'";}?>>Want to get email notifications
			</li>
			<li>
				<input type="submit" value="Update">
			</li>
			<li>
				<a href="changepassword">Change password</a>
			</li>
		</ul>
	</form>
</div>
			<div class="right-settings">
<?php
				if(isset($_FILES['profile']) === true){
					if(empty($_FILES['profile']['name']) === true){
						echo "<div class='img-file-error'>Please choose a file!</div>";
					}else{
						$allowed = array('jpg', 'jpeg', 'gif', 'png');//допустимые форматы файла
						$file_name = $_FILES['profile']['name'];
						$file_extn = strtolower(end(explode('.', $file_name)));
						$file_temp = $_FILES['profile']['tmp_name'];
						if(in_array($file_extn, $allowed) === true){
							change_profile_image($session_user_id, $file_temp, $file_extn);// смена аватара
							header('Location: settings');
							exit();
						}else{
							echo "<div class='img-file-error'>Incorrect file type!<br>
								Allowed types: ";
								echo implode(', ',$allowed);
							echo ".</div>";
							}
						}
				}
				if(!empty($user_data['profile'])){
					echo '<img id="previewImg" class="img-settings" width="250px" src="', $user_data['profile'], '" alt="',$user_data['first_name'],'\'s profile image">';
				}
			?>
				<form action="" method="post" enctype="multipart/form-data">
					<input type="file" accept="image/*" onchange="preview(this.value)" name="profile"><br>
					<input class='green-border' type="submit" value="Change photo">
				</form>
			</div>
<?php
	include 'includes/overall/footer.php';?>