<?php
 //Srinivas Tamada http://9lessons.info
//Load latest comment 
include_once 'includes.php';

if(isSet($_POST['fid']))
{
$fid=$_POST['fid'];
$cdata=$Wall->Add_Friend($uid,$fid);
echo $cdata;
}
?>
