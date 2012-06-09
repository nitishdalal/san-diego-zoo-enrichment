<?php
session_start();
$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("db415791251", $con);


//$species = $_POST['species']; //enrichment_id corresponding to this enrichment needed
//$id = 225; //$_POST['enrichment'];
$name = $_POST['name'];
$category = $_POST['category'];
$subcat = $_POST['subcat'];

$query2 = "Select max(enrichment_id) as max_id from enrichment ";
$result2=mysql_query($query2);
$row2=mysql_fetch_array($result2);
$id=$row2['max_id']+1;


$query = "INSERT INTO enrichment VALUES ('$id','$name','$category', '$subcat', 0)";
$result = mysql_query($query);
echo $query;

mysql_close($con);

?>