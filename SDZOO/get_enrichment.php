<?php
session_start();
$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("db415791251", $con);

$animal_id = $_POST['id'];

$enrichment = mysql_query("select enrichment.enrichment_id, enrichment.enrichment_name from enrichment, animal, species_enrichment where animal.animal_species = species_enrichment.species_id and species_enrichment.enrichment_id = enrichment.enrichment_id and animal_id = ".$animal_id );

															
while ($row=mysql_fetch_array($enrichment))
	{
	echo "<option value = $row[enrichment_id]>$row[enrichment_name]</option>";
	}

mysql_close($con);
?>