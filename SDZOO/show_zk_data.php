<?php
	session_start();
	$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("db415791251", $con);
	
	$zkname = $_POST['zkname'];
	
	//Need to check to make sure zookeeper name is in DB
	
	//This query finds all the animals for this zookeeper & orders the output by species
	$query = "SELECT animal_id, animal_name, animal_species.species_name FROM animal,animal_species WHERE animal_id IN (SELECT animal_id FROM zookeeper_animal WHERE zookeeper_id=(SELECT id FROM zookeeper_name WHERE name='$zkname')) AND animal.animal_species = animal_species.species_id ORDER BY animal_species.species_name";
	
	$result = mysql_query($query);
	
	echo "<div id='anim_zks'><h3 class='offset2'>$zkname's Animals</h3>";
	echo "<table id='zkdtbl' class='table table-striped table-bordered span4 offset2'>
			<thead><th>Animal Name</th></thead>
			<tbody>";
			
	while($row = mysql_fetch_array($result))
	{
	
		echo "<tr><td>".$row['animal_id']."</td><td id='anim_name'>".$row['animal_name']."</td><td>".$row['species_name']."</td><td><button id='removeAnimal' class='btn btn-danger'>Remove</button></td></tr>";
	} 	
		
	echo "<tr><td><input type='text' id='zk_new_anim_id' placeholder='Animal ID'></td><td><input type='text' id='zk_new_anim_name' placeholder='Animal Name'></td><td><input type='text' id='zk_new_anim_spec' placeholder='Animal Species'></td><td><button class='btn btn-info' id='add_anim_zk'>Add</button></td> </tr>";
	echo "</tbody></div>";
	
	echo "	<script type='text/javascript'>
				var nm='';
				$('[id=removeAnimal]').click(function(){			
					$('#RemoveAlert2').show();
					nm = $(this).parents('tr').children('td:first-child').text();
					
				});
				
				$('#RemoveAnimal2').click(function(){
					zk_nm = $('#zk_name').val();
					$.post('remove_anim_from_zk.php', {zkname:zk_nm, animName:nm});
					$('#zkDataTable').load('show_zk_data.php', {zkname:zk_nm});
					$('#RemoveAlert2').hide();
					$('#RemoveSuccess').show();
				});	
				
				$('#add_anim_zk').click(function(){
					a_id = $('#zk_new_anim_id').val();
					a_nm = $('#zk_new_anim_name').val();
					a_sp = $('#zk_new_anim_spec').val();
					zk_nm = $('#zk_name').val();
					$.post('add_anim_zk.php', {a_id:a_id, a_nm:a_nm, a_sp:a_sp});
					$('#anim_zks').load('show_zk_data.php',{zkname:zk_nm});
				
				});
		</script>";
	
	mysql_close($con);
?>