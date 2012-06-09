<?php
	session_start();
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con);
	
	$enid 		= $_POST['en_id'];
	$enname  	= $_POST['en_name'];
	$encat 		= $_POST['en_cat'];
	$ensubcat 	= $_POST['en_subcat'];

	//How do we we want to assign IDs?
	$query = "INSERT INTO enrichment VALUES ('$enid','$enname','$encat', '$ensubcat', 0)";
	$result = mysql_query($query);
	mysql_close($con);
?>