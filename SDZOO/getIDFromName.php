<?php
	//Can zookeeper view animal data for animal that is not theres?
	
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con);


	
	$animalName = $_POST['animalName'];
	$query = "SELECT animal_id FROM animal WHERE animal_name = '$animalName'";
	$anim_id = mysql_query($query);
	$row = mysql_fetch_array($anim_id);
	echo $row['animal_id'];
	

	mysql_close($con);
?>
