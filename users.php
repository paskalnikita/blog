<?php
	$title = 'Users';
	include 'core/init.php';
	protect_page();
	include 'includes/overall/header.php';?>
	<h1>Users list</h1>
		<div style="float:left;margin-left:5px;">
			<form action="" method="post"> 
			<input type="text" name="search" style="border:2px solid #40C781;height:19px;width: 270px;" placeholder="Enter username" class='round'/>
		</form>
		</div>
	<?php
		$search_query=$_REQUEST['search'];
			if(!empty($search_query)){
				search_users($search_query);
			}else{?>
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
				if(isset($_GET['page'])) {
					$page = $_GET['page'];
				}else{
					$page=1;
					}
			show_users_list($sort_type,$page);
		}
	include 'includes/overall/footer.php';?>