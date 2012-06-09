<?php
session_start();

$con = mysql_connect('db415791251.db.1and1.com','dbo415791251','sdzoo130');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("db415791251", $con);

$query = "SELECT name FROM zookeeper_name WHERE id = '" . $_POST['id']."'";

$result = mysql_query($query);

$row = mysql_num_rows($result);
if($row==1)
	{
	$_SESSION['id']=$_POST['userid'];
	header('Location: http://neerajkhurana.com/SDZOO/home.php');
	}
else
	{
	header( 'Location: http://neerajkhurana.com/SDZOO/login.php' ) ;
	}
 mysql_close($con);
?>