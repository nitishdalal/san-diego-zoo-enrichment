<?php
	session_start();
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
		
	mysql_select_db("db415791251", $con);

	//This file is called from PHP generated code in show_zks.php, Line 66
	
	$zkname = $_POST['zkname'];
	$aname  = $_POST['animName'];
	
	//Delete element that matches zookeeper & animal ID pair
	$query = "DELETE FROM zookeeper_animal WHERE zookeeper_id = (SELECT id from zookeeper_name WHERE name = '$zkname') AND animal_id = (SELECT animal_id FROM animal WHERE animal_name = '$aname')";
	$result = mysql_query($query);
	
	mysql_close($con);
?>