<?php
session_start();
$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("db415791251", $con);

date_default_timezone_set('America/Los_Angeles');

$animal_id = $_POST['animal_id'];
$date = $_POST['date'];
$time = $_POST['time'];
$iu = $_POST['iu'];

$v8='None';

$query = "UPDATE enrichment_animal SET indirect_use ='".$iu."' WHERE date = '".$date."' AND time='".$time."' AND animal_id = ".$animal_id;
echo $query;

$result = mysql_query($query);

mysql_close($con);

?>