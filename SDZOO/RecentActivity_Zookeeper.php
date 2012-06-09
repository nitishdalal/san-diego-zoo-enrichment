<?php
	session_start();
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con);


	
	$time = $_POST['time'];
	//time can have 3 value: TwoWeeks FourWeeks All
	//depending on value output table
	
	//INPUT QUERY and send to database
	
	if($time == 'TwoWeeks')
		{
		$diff = 14*24*60*60;
		}
	if($time == 'FourWeeks')
		{
		$diff = 28*24*60*60;
		}
		
	$time_now=strtotime('now'); //present time
	$query="SELECT enrichment_animal.*, animal.animal_name, enrichment.enrichment_name FROM enrichment_animal,enrichment, animal WHERE enrichment_animal.animal_id = animal.animal_id AND enrichment_animal.enrichment_id = enrichment.enrichment_id AND zookeeper_id =".$_SESSION['id']." ORDER by date desc"; //query to retrieve all records for this zookeeper
	
	
	$result = mysql_query($query);
    					
	
		echo "<div id='species_animalTable'><table class ='table table-striped table-bordered'>
    	<thead><tr>
    	<th>Select Animal</th>
    	<th>Animal Name</th>
    	<th>Enrichment</th>
    	<th>Date</th>
    	<th>Duration Observation</th>
    	<th>Duration Interaction</th>
		<th>Percent Interaction</th>
    	<th>Behavior</th>
    	<th>Behavior Positive</th>
    	<th>Indirect Use</th>
    	
    	</tr></thead><tbody>";
	
	while($row = mysql_fetch_array($result))
		{
			//$value= $row['animal_name'] . "," .$row['animal_']. "," .$row['animal_id']; //time has to be in value also
			//echo "<tr><td><input type='radio' name='animal_name'  value='$value' /></td><td>".$row['animal_name']."</td><td>".$row['animal_id']."</td></tr>";
		$percent_rate = 100*$row['rate'];
		$time_of_row=strtotime($row['date']);
		if($time=='All')
		{
			$value= $row['time'] . "," .$row['animal_id']. "," .$row['animal_name']. "," .$row['date'];
			if($row[indirect_use]=="None")
			{
				echo "<tr><td><input type='radio' name='animal' value='$value' /></td><td>$row[animal_name]</td><td>$row[enrichment_name]</td><td>$row[date]</td><td>$row[duration_observed]</td><td>$row[duration_interaction]</td><td>$percent_rate%</td><td>$row[behavior]</td><td>$row[behavior_pos]</td><td>Not inputted</td></tr>";
			}
			else
			{
				echo "<tr><td></td><td>$row[animal_name]</td><td>$row[enrichment_name]</td><td>$row[date]</td><td>$row[duration_observed]</td><td>$row[duration_interaction]</td><td>$percent_rate%</td><td>$row[behavior]</td><td>$row[behavior_pos]</td><td>$row[indirect_use]</td></tr>";
			}
			
		}

		elseif($time_now-$time_of_row < $diff)
		{
			
			$value= $row['time'] . "," .$row['animal_id']. "," .$row['animal_name']. "," .$row['date'];
			if($row[indirect_use]=="None")
			{
				echo "<tr><td><input type='radio' name='animal' value='$value' /></td><td>$row[animal_name]</td><td>$row[enrichment_name]</td><td>$row[date]</td><td>$row[duration_observed]</td><td>$row[duration_interaction]</td><td>$percent_rate%</td><td>$row[behavior]</td><td>$row[behavior_pos]</td><td>Not inputted</td></tr>";
			}
			else
			{
				echo "<tr><td></td><td>$row[animal_name]</td><td>$row[enrichment_name]</td><td>$row[date]</td><td>$row[duration_observed]</td><td>$row[duration_interaction]</td><td>$percent_rate%</td><td>$row[behavior]</td><td>$row[behavior_pos]</td><td>$row[indirect_use]</td></tr>";
			}
		}
		}
		
		
		
		
		
		
	echo "</tbody></table>";
	echo "<a class='btn btn-primary btn-large' data-toggle='modal' href='#IndirectUse'>Add Indirect Use</a>";
	

	
	echo "<script type='text/javascript'>
	$('#IndirectUse').click(function(){
	value=$('input[name=animal]:checked').val();
	var arr = value.split(',');
	$('#animal_ID_IU').val(arr[1]);
	$('#animal_Name_IU').val(arr[2]);
	$('#time_hidden').val(arr[0]);
	$('#date_hidden').val(arr[3]);

	

	
	
	});
	
	
	

	</script>";
	
?>