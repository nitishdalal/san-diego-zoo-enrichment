<?php
	//Can zookeeper view animal data for animal that is not theres?
	
	$con2 = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con2)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con2);

	
	//$_SESSION['id']=$_POST['userid'];
	
	$animalName = $_GET['animName'];
	$query = "SELECT * FROM enrichment_animal WHERE animal_id IN (
	SELECT animal_id FROM animal WHERE animal_name =". $animalName .")";
	$anim_data = mysql_query($query);
	
	echo $query;
	echo "<table class=\"table-striped\">
	<thead> <td>Duration Observed</td>
			<td>Indirect Use</td>
			<td>Behavior</td>
			<td>Behavior Pos</td>
			<td>Duration Interaction</td>
	</thead><tbody>";
	while($row = mysql_fetch_array($anim_data))
		{
			echo "<tr><td>".$row['duration_observed']."</td><td>".$row['indirect_use']."</td><td>".$row['behavior']."</td><td>".$row['behavior_pos']."</td><td>".$row['duration_interaction']."</td></tr>";
		}
	echo "</tbody></table>";
	
	mysql_close($con2);
?>