<?php
	$title = 'Users';
	include 'core/init.php';
	protect_page();
	include 'includes/overall/header.php';?>
	<h1>Users list</h1>
		 <section class="as">
					<div id="dd" class="dropdown-list" tabindex="1">Sort by:
						<ul class="dropdown">
							<li class="no-padding"><a href="users?sort_by_id">Id</a></li>
							<li class="no-padding"><a href="users?sort_by_username">Username</a></li>
						</ul>
					</div>
			</section>
			<?php
				if(isset($_GET['sort_by_username'])){
					$sort_type = 'username';
				}elseif(isset($_GET['sort_by_id'])){
					$sort_type = 'user_id';
				}elseif(!isset($_GET['sort_by_username']) && !isset($_GET['sort_by_id'])){
					$sort_type = 'user_id';
				}
				show_users_list($sort_type);
	include 'includes/overall/footer.php';?>