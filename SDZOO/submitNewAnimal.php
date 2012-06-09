<?php
	session_start();
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	//This code adds an animal into the zoo via the super user page. It also outputs an additional table allowing  you to add multiple zookeeepers
	mysql_select_db("db415791251", $con);

	if ( !empty($_POST['animalID']) & !empty($_POST['animalName']) & !empty($_POST['animalSpecies'])){
		$animalID = $_POST['animalID'];
		$animalName = $_POST['animalName'];
		$animalSpec = $_POST['animalSpecies'];
		
		$query = "INSERT INTO animal (animal_id, animal_name, animal_species) VALUES('$animalID', '$animalName', '$animalSpec')";
		$result = mysql_query($query);
		
		if ($result){
			echo "<div class='alert alert-block alert-success fade in span4 offset3' id='insertAnimalZKSuccess'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
					<h4 class='alert-heading'>Animal has been added!</h4>
				</div>";
				
			echo "<hr>
				<table id='newAnimalZKtbl' class='table table-striped table-bordered span4 offset3'>
				<thead><th>Add Zookeepers to $animalName</th></thead>
				<tbody>	";
				
			echo "<tr><td><input type='text' id='zk_name' placeholder='Add New Zookeeper' data-provide='typeahead' data-items='4' data-source='[";
				//This query finds all zookeepers names
				$query3 = "SELECT name FROM zookeeper_name";
				$name_list = mysql_query($query3);
				$output = '';
				while($row2 = mysql_fetch_array($name_list)){
					$output .= "\"";
					$output .= $row2['name'];
					$output .= "\",";
				}	
				$output = rtrim($output, "\,");
				echo $output;
			echo "]'></td><td><button id='add_zk' onclick='updateZKtable()' class='btn btn-info'>Add</button></td></tr>";
			echo "</tbody></table>";

			echo "<script type='text/javascript'>
						$('[id=add_zk]').click(function(){
							val1 = $('#zk_name').val();
							val2 = $('#animal_Name').val();
							val3 = $('#animal_Species').val();
							val4 = $('#animal_ID').val();
							$.post('add_zk_to_animal.php', {zkname:val1, animname:val2});
							//$('#newAnimalZKtbl').load('submitNewAnimal.php', {animalID:val4, animalName:val2, animalSpecies:val3});
						});
											
						
						function updateZKtable(){
							var tblInsert = document.getElementById('newAnimalZKtbl').insertRow(1);
							var nameInsert = tblInsert.insertCell(0);
							var buttonInsert = tblInsert.insertCell(1);
							var name1 = document.getElementById('zk_name');
							var name2 = name1.value;
							nameInsert.innerHTML = name2;

						}
				  </script>";	
		}
		else{
			echo "<div class='alert alert-block alert-error fade in span4 offset3' id='insertAnimalZKFail'>
					<button type='button' class='close' data-dismiss='alert'>&times;</button>
						<h4 class='alert-heading'>Error adding animal!</h4>
				  </div>";			
		}
		//$query2 = "INSERT INTO zookeeper_animal VALUES ('$animID', '$zkID')";
		//$result2 = mysql_query($query2);
		

	}
	else {
		echo "<div class='alert alert-block alert-error fade in span4 offset3' id='RemoveAlert3'>
				<button type='button' class='close' data-dismiss='alert' >&times;</button>
					<h4 class='alert-heading'>Please complete all fields!</h4>
			  </div>	
			";
	}
	


	mysql_close($con);
?>