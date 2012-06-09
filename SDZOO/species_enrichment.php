<?php
session_start();
$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("db415791251", $con);

$species = $_POST['species'];

$query = "select * from enrichment where enrichment.enrichment_id IN (select enrichment_id from species_enrichment where species_enrichment.species_id = (select species_id from animal_species where animal_species.species_name = '". $species."'))";
$enrichment = mysql_query($query);

$e_list = mysql_query("SELECT enrichment_name FROM enrichment where enrichment_id not in (select enrichment_id from species_enrichment where species_id = (select species_id from animal_species where species_name = '".$species."'))");
$output = "";
							while($row = mysql_fetch_array($e_list)){
								$output .= "\"";
								$output .= $row['enrichment_name'];
								$output .= "\",";
							}	

							$output = rtrim($output, "\,");


//echo $output;
echo "<table id='enrichTable' class='table table-striped table-bordered span8 offset2'>
 <thead><th>Enrichment Item</th><th>Enrichment Category</th><th>Enrichment Subcategory</th><th></th></thead><tbody>";
 
 

while ($row=mysql_fetch_array($enrichment))
	{
	echo "<tr><td>".$row['enrichment_name']."</td><td>".$row['enrichment_category']."</td><td>".$row['enrichment_subcategory']."</td><td><button class='btn btn-danger removeE'>Remove</button></td></tr>";
	}
	
echo "<tr><td><input type='text' id='e_newname' placeholder='Enrichment Name' data-provide='typeahead' data-items='4' data-source='[$output]'></td><td></td><td></td><td><button class='btn btn-primary' id='addEnrich'>Add</button></td></tr>
                                        </tbody></table>";
                                        
                                        echo"<div id='t'></div>";
                                        
                                        
        echo "<script type='text/javascript'>
        
        $('.removeE').click(function(){
        val1 = $(this).parents('tr').children('td:first-child').text();
        val2=$('#AnimalSpecies_E').val();
        $.post('delete_species_enrichment.php', {name:val1, species:val2});
		$('#ShowEnrichmentFromSpecies').load('species_enrichment.php',{species:val2});
		});
        
        
		
		$('#addEnrich').click(function(){
		val1 = $('#e_newname').val(); 
		val4=$('#AnimalSpecies_E').val();
		$.post('insert_enrichment_species.php', {name:val1, species:val4});
		$('#ShowEnrichmentFromSpecies').load('species_enrichment.php',{species:val4});
		});
	

	</script>";
                                        
                                        
                                        
      
                                        


	

	

	


mysql_close($con);
?>