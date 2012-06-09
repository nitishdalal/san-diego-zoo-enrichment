<?php
	session_start();
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con);

	if (!empty($_POST['animalName'])){
		$animName = $_POST['animalName'];
		
		//Delete animal from zookeper_animal & animal tables
		$query1 = "DELETE FROM zookeeper_animal WHERE animal_id = (SELECT animal_id FROM animal WHERE animal_name = '$animName'";
		$query2 = "DELETE FROM animal WHERE animal_name = '$animName'";

		$result1 = mysql_query($query1);
		$result2 = mysql_query($query2);
	}	

	mysql_close($con);
?>