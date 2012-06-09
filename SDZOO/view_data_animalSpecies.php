<?php
	//Can zookeeper view animal data for animal that is not theres?
	session_start();
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con);


	
	$animalSpecies = $_POST['species'];
	
	$query1 = "Select * from animal where animal_id in (Select animal_id from zookeeper_animal where zookeeper_id ='" . $_SESSION['id'] ."' and animal_id in (SELECT animal_id FROM `animal` WHERE animal_species IN (SELECT species_id FROM animal_species
	WHERE species_name ='$animalSpecies'))) ";
	
	//echo $query1;
	//echo "<br/>";
	//$query = "SELECT * FROM `animal` WHERE animal_species IN (SELECT species_id FROM animal_species
	//WHERE species_name ='$animalSpecies')";
	
	$anim_data = mysql_query($query1);
	
	/*Same logic as view_data_animalNAME . THE ABOVE QUERY SHOULD ACCOUNT FOR animals of that species that ACTUALLY belong to zookeeper*/
	if(mysql_num_rows($anim_data)==0)
		{
		echo "<div class='alert alert-error'>
    <button class='close' data-dismiss='alert'>×</button>
    No animal of this species is under your care. Please doublecheck your input.
    </div>";
		}
	else
		{
	echo "<div id='species_animalTable'><table class ='table table-striped'>
    	<thead><tr>
    	<th></th>
    	<th>Animal Name</th>
    	<th>Animal I.D.</th></tr></thead><tbody>";
    					
	
	while($row = mysql_fetch_array($anim_data))
		{
			$value= $row['animal_name'] . "," .$row['animal_id']; 
			echo "<tr><td><input type='radio' name='animal_name'  value='$value' /></td><td>".$row['animal_name']."</td><td>".$row['animal_id']."</td></tr>";
		}
	echo "</tbody></table>";
	echo "<div class='row'>
  							  <div class = 'span3 offset3'>
    				 			<a class='btn btn-primary btn-large' id='AddNewEnrichmentFromSpecies' data-toggle='modal' href='#newObs' >Add New Enrichment</a>
    				 	  	  </div>
    				 	  	  <div class = 'span 3'>
    				 	  	  	<a class='btn btn-success btn-large' id='ViewDataFromSpecies'>View Animal's Existing Data</a>
    				 	  	  </div>
    				 	</div></div>";
    				 	
    	}		
    			
	


	
		echo "<script type='text/javascript'>
	$('#AddNewEnrichmentFromSpecies').click(function(){
	value=$('input[name=animal_name]:checked').val();
	var arr = value.split(',');
	$('#animal_Name').val(arr[0]);
	$('#animal_ID').val(arr[1]);
	$('#enrichList').load('get_enrichment.php',{id:arr[1]});
	
	
	});
	
	$('#ViewDataFromSpecies').click(function(){
	value=$('input[name=animal_name]:checked').val();
	var arr = value.split(',');
	$.post('view_data_animalName.php', {animalName:arr[0]}, function(result){
	$('#species_animalTable').html(result);});
	});
	</script>";
	



    			
	
	
	mysql_close($con);
?>