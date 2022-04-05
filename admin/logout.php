<?php 
	include"db-con.php";

	session_start();

	session_unset();

	session_destroy();

	header("location: http://localhost/NewsProject/admin/")
 ?>
