<?php
	session_start();
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con);

	$zkName = $_POST['zkname'];
	$zkID = $_POST['zkID'];
	
	$query = "INSERT INTO zookeeper_name (id, name, deleted) VALUES('$zkID', '$zkName',0)";
	
	$result = mysql_query($query);
	
	if ($result){
		echo "<div class='alert alert-block alert-success fade in span4 offset3' id='RemoveAlert5'>
		<button type='button' class='close' data-dismiss='alert' >&times;</button>
			<h4 class='alert-heading'>Zookeeper successfully added!</h4>
		</div>	
		";	
	
	}
	else{
		echo "<div class='alert alert-block alert-error fade in span4 offset3'>
				<button type='button' class='close' data-dismiss='alert' >&times;</button>
					<h4 class='alert-heading'>Error adding zookeeper.</h4>
			  </div>	
			";	
	}
	
	mysql_close($con);
?>