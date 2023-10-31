<?php
if(session_id()=='')
{
session_start();
	
}
$mysql_db = 'db_equipride';
$con=mysqli_connect(
"localhost","root","", $mysql_db) or die("connection error");

$title='Equipride';
?>
<?php

$_prefix_user='USER00';
$_prefix_dealer='DEALER00';

?>