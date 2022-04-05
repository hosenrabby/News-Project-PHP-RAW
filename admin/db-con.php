<?php
	$dbcon = new mysqli("localhost", "root", "", "news-application");

	if ($dbcon->connect_error) {
		die("Database Connection Promlem ...");
	}
 ?>