<?php
error_reporting(0);
include_once 'includes/db.php';
include_once 'includes/Wall_Updates.php';
$Wall = new Wall_Updates();
if(isSet($_POST['email']))
{
$value=$_POST['email'];
$check=$Wall->Login_Check($value,0);
if($check)
{
echo '<font color="#cc0000"><STRONG>'.$value.'</STRONG> is already in use.</font>';
}
else
{
echo 'OK';
}
}
?>