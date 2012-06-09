<?php
	session_start();
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con);
	
	$zkname = $_POST['zkname'];
	
	
	$query1 = "UPDATE zookeeper_name SET deleted=1 WHERE name='$zkname'"; //updating the deleted field in zookeeper_name table to 1
	$result1 = mysql_query($query1);
	$query2 = "DELETE FROM zookeeper_animal WHERE zookeeper_id=(SELECT id FROM zookeeper_name WHERE name='$zkname')"; //as the zookeeper is marked as deleted, we delete all zookeeper_animal relations for that id
	$result2 = mysql_query($query2); 
	
	mysql_close($con);
?>