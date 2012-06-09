<?php
	session_start();
	//Can zookeeper view animal data for animal that is not theres?
	
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con);

/*Check that the animal actually belongs to that zookepper! AND CHECK if animal exists in the first place .... simple if statements */
	
	$animalName = $_POST['animalName'];
	
	$query1="Select * from zookeeper_animal where zookeeper_id ='" . $_SESSION['id'] ."' and animal_id in (select animal_id from animal where animal_name = '$animalName')";
	//echo "<br/>";
	//echo $query1;
	//echo "<br/>";
	$anim_check=mysql_query($query1);
	
	if(mysql_num_rows($anim_check)==0)
		{
		echo "<div class='alert alert-error'>
    <button class='close' data-dismiss='alert'>×</button>
    The requested animal is not under your care or does not exist at the zoo! Please doublecheck your input.
    </div>";
		}
	else
		{
	$query = "SELECT enrichment_animal.*, enrichment.enrichment_name FROM enrichment_animal,enrichment WHERE enrichment_animal.enrichment_id = enrichment.enrichment_id AND animal_id IN (SELECT animal_id FROM animal WHERE animal_name = '$animalName' ) Order by date desc";
	$anim_data = mysql_query($query);
	
	//echo $query;
	$name=$animalName ."'s Data";
	echo "<h2 class='offset4'>$name</h2><br/>";
	
	echo "<table class=' table table-striped table-bordered'>
	<thead> 
			<td>Date</td>
			<td>Enrichment</td>
			<td>Duration Observation</td>
			<td>Duration Interaction</td>
			<td>Percent Interaction</td>
			<td>Behavior</td>
			<td>Behavior Positive</td>
			<td>Indirect Use</td>
	</thead><tbody>";
	while($row = mysql_fetch_array($anim_data))
		{
		$percent_rate=100*$row['rate'];
			if($row[indirect_use]=="None"){
			echo "<tr><td>".$row['date']."</td><td>".$row['enrichment_name']."</td><td>".$row['duration_observed']."</td><td>".$row['duration_interaction']."</td><td>".$percent_rate."%</td><td>".$row['behavior']."</td><td>".$row['behavior_pos']."</td><td>Not Inputted</td></tr>";}
			else {echo "<tr><td>".$row['date']."</td><td>".$row['enrichment_name']."</td><td>".$row['duration_observed']."</td><td>".$row['duration_interaction']."</td><td>".$percent_rate."%</td><td>".$row['behavior']."</td><td>".$row['behavior_pos']."</td><td>".$row['indirect_use']."</td></tr>";}
			
		}
	echo "</tbody></table>";
	}
	
	
	mysql_close($con);
?>