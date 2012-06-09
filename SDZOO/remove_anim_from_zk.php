<?php
	session_start();
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con);

	//this script is called from PHP generated code in the file "show_zk_data.php" line 51
	$zkname = $_POST['zkname'];
	$animname = $_POST['animName'];
	
	$query1 = "UPDATE animal SET deleted=1 WHERE animal_id=(SELECT animal_id FROM animal WHERE animal_name='$animname')";
	$result1 = mysql_query($query1);
	$query2 = "DELETE FROM zookeeper_animal WHERE ( animal_id=(SELECT animal_id FROM animal WHERE animal_name='$animname') AND zookeeper_id=(SELECT id FROM zookeeper_name WHERE name='$zkname') )";
	$result2 = mysql_query($query2);
	mysql_close($con);
?>