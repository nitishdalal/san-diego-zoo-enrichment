<?php
	session_start();
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con);
	
	//This script displays the table of zookeepers for a given animal under the Animal tab for the super user
	if ( !empty($_POST['animalName'])){
		$animName = $_POST['animalName'];
		
		$query = "SELECT name FROM zookeeper_name WHERE id IN
					(SELECT zookeeper_id FROM zookeeper_animal WHERE animal_id = 
						(SELECT animal_id FROM animal WHERE animal_name = '$animName'))";
						
		$result = mysql_query($query);
		if (!(mysql_num_rows($result) == 0)){ 
			echo "<div id='anim_zks'><h3 class='offset3'>$animName's Zookeepers</h3>";
			echo "<table id='zktbl' class='table table-striped table-bordered span4 offset3'>
					<thead><th>ZooKeeper Name</th></thead>
					<tbody>";
					
			while($row = mysql_fetch_array($result))
			{
				echo "<tr><td id='zkname'>".$row['name']."</td><td><button id='removeZooKeeper' class='btn btn-danger'>Remove</button></td></tr>";
			} 
			
			echo "<tr><td><input type='text' id='zk_name' placeholder='Add New Zookeeper' data-provide='typeahead' data-items='4' data-source='[";
				//This query finds all zookeepers names
				$query2 = "SELECT name FROM zookeeper_name WHERE id NOT IN
						(SELECT zookeeper_id FROM zookeeper_animal WHERE animal_id = 
							(SELECT animal_id FROM animal WHERE animal_name = '$animName'))";
				$name_list = mysql_query($query2);
				$output = '';
				while($row = mysql_fetch_array($name_list)){
					$output .= "\"";
					$output .= $row['name'];
					$output .= "\",";
				}	
				$output = rtrim($output, "\,");
				echo $output;
			echo "]'></td><td><button id='add_zk' class='btn btn-info'>Add</button></td></tr>";
			echo "</tbody></table>";
			
			echo "</div>";
			echo "	<script type='text/javascript'>
						var nm='';
						$('[id=removeZooKeeper]').click(function(){			
							$('#RemoveZKalert').show();
							nm = $(this).parents('tr').children('td:first-child').text();
							
						});
						
						$('#RemoveZK').click(function(){
							a_nm = $('#animName').val();	
							$('#zktbl').load('remove_zk_from_anim.php', {zkname:nm, animName:a_nm});
							$('#RemoveZKalert').hide();
							$('#RemoveZKSuccess').show();
							$('#zkTable').load('show_zks.php', {animalName:value});
							
						});	
						
						$('#add_zk').click(function(){
							val1 = $('#zk_name').val();
							val2 = $('#animName').val();
							$('#anim_zks').load('add_zk_to_animal.php', {zkname:val1, animname:val2});	
							$('#zkTable').load('show_zks.php', {animalName:value});
						});
					</script>";
		}
		else{
			echo "<div class='alert alert-block alert-error fade in span4 offset3'>
					<button type='button' class='close' data-dismiss='alert' >&times;</button>
						<h4 class='alert-heading'>Please enter valid animal name.</h4>
				  </div>	
				";		
		}
	}
	else{
		echo "<div class='alert alert-block alert-error fade in span4 offset3'>
				<button type='button' class='close' data-dismiss='alert' >&times;</button>
					<h4 class='alert-heading'>Please enter valid animal name.</h4>
			  </div>	
			";
	
	}
	mysql_close($con);
?>