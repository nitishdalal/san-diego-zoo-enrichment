<?php
	session_start();
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con);
	
	
	$animID = $_POST['a_id'];
	$animName = $_POST['a_nm'];
	$animSpec = $_POST['a_sp'];
	
	
	mysql_close($con);
?>