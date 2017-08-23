<?php
	include 'core/init.php';
	$title ="Search";
	protect_page();
	include 'includes/overall/header.php';?>
	<h1>Search</h1>
		<div id="content">
<?php
		if(isset($_GET['tag'])){
			$tag='#'.$_GET['tag'];
			$adres = $_SERVER['REQUEST_URI'];
			$tags_in_adres = substr($adres, 12);
			$pretags = explode("&", $tags_in_adres);
			$tags_list=array();
			foreach($pretags as $param=>$value){
				$tag='#'.$value;
				array_push($tags_list, $tag);
			}
				show_comments_with_tag($tags_list);
				show_pics_with_tag($tags_list);
				show_blogs_with_tag($tags_list);
		}else{
			echo 'Search query is empty!';
		}
include'includes/overall/footer.php';?>