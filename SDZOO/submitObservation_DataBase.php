<?php
session_start();
$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("db415791251", $con);

date_default_timezone_set('America/Los_Angeles');
$v1 = $_POST['animalID'];
$v2 = $_SESSION['id'];
$time_now = date("H:i:s");
$date_now = date("y.m.d");
$v3 = $_POST['enrichment']; //enrichment_id corresponding to this enrichment needed
$v4 = $_POST['Duration_Observation'];
$v6 = $_POST['Behavior'];
$v7 = $_POST['Behavior_Positive'];
$v5 = $_POST['Duration_Interaction'];

$v8='None';
$v9=(int)$v5/(int)$v4;

//echo "$v1 $v2 $time_now $date_now $v3 $v4 $v5 $v6 $v7"
//(animal_id,zookeeper_id, date,time, enrichment_id, duration_observed, indirect_use, behavior, behavior_pos, duration_interaction)
$query = "INSERT INTO enrichment_animal VALUES(".$v1.",".$v2.",'".$date_now."','".$time_now."',".$v3.",".$v4.",'".$v8."','".$v6."','".$v7."',".$v5.",".$v9.")";
echo $query;

$result = mysql_query($query);

mysql_close($con);

?>
