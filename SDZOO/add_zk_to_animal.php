<?php
	session_start();
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con);

	//This script is called from php generated code in 'show_zks.php'
	$zkname   = $_POST['zkname'];
	$animName = $_POST['animname'];
	
	//Obtaining animal ID's from animal names to use in final query
	$zk_query = "SELECT id FROM zookeeper_name WHERE name = '$zkname'";
	$anim_query = "SELECT animal_id FROM animal WHERE animal_name = '$animName'";
	$result1 = mysql_query($zk_query);
	$result2 = mysql_query($anim_query);
	$zk_id = mysql_fetch_array($result1);
	$a_id = mysql_fetch_array($result2);
	$zookeeper_id = $zk_id['id'];
	$animal_id = $a_id['animal_id'];
	
	//Will need a check later to make sure that this relation does not already exist
	$query = "INSERT INTO zookeeper_animal VALUES('$zookeeper_id', '$animal_id');";
	$result = mysql_query($query);
	mysql_close($con);
?>