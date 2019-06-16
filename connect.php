<?php
	$mysqli = new MySQLi("localhost", "bikashma_pathology", "rkb#PATH#das", "bikashma_pathology");
	$mysqli->set_charset('utf8');
	
	if($mysqli->connect_error)
	{
		echo $mysqli->connect_errno;	
	}
?>