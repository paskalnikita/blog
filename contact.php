<?php
	include 'core/init.php';
	$title ="Contact us";
	include 'includes/overall/header.php';?>
	<h1>Contact us</h1> 
	<p>
				<?php
					protect_page();
					if(logged_in()){
						echo "Please field this form for contacting us:
							<form action='' method='post'>";
									echo 'Username: ' .$user_data['username'].'.';?>
									<br>
									<div class="message-box">
										<textarea name="" id="comment_area" cols="50" rows="7" name="comment" placeholder='Please,leave a message'></textarea>
										<input type="submit" value='Send' class="submit-button">
									</div>
									<?php
					}
?>
						</form>
	</p>
<?php
include'includes/overall/footer.php';
?>