<?php
session_start();
$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("db415791251", $con);


$species = $_POST['species']; //enrichment_id corresponding to this enrichment needed
$name = $_POST['name'];

$query3="Select enrichment_id from enrichment where enrichment_name= '".$name."'";
$result3=mysql_query($query3);
$row3=mysql_fetch_array($result3);

$id=$row3['enrichment_id'];

$query1="Select species_id from animal_species where species_name = '".$species."'";
$result1=mysql_query($query1);
$row=mysql_fetch_array($result1);

$id_species=$row['species_id'];

$query2 = "INSERT INTO species_enrichment values ('$id_species','$id')";
$result = mysql_query($query2);

mysql_close($con);

?>