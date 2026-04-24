<?php
error_reporting(0);
include_once 'includes/db.php';
include_once 'includes/Wall_Updates.php';
$Wall = new Wall_Updates();
if(isSet($_POST['username']))
{
$value=$_POST['username'];
$check=$Wall->Login_Check($value,1);
if($check)
{
echo '<font color="#cc0000">Username not available. Use 3 or more characters.</font>';
}
else
{
echo 'OK';
}
}
?>