<?php
	$connect_error = "Cant connect!";
	MYSQL_connect("Localhost","root","") or die(mysql_error());//подлючение к БД
	MYSQL_select_db("blog") or die ($connect_error);//выбор БД
	// $connect = new mysqli('Localhost', 'root', '', 'blog');
	@mysql_query ("SET NAMES `UTF8`");
	mysql_query("SET NAMES 'utf8';");
	mysql_query("SET CHARACTER SET 'utf8';");
	mysql_query("SET SESSION collation_connection = 'utf8_general_ci';");
?>