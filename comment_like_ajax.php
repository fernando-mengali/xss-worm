<?php
 //Srinivas Tamada http://9lessons.info
//Load latest comment 
include_once 'includes.php';

if(isSet($_POST['com_id']) && isSet($_POST['rel']))
{
$com_id=$_POST['com_id'];
$rel=$_POST['rel'];
if($rel=='Like')
{
$cdata=$Wall->Comment_Like($com_id,$uid);	
}
else
{
$cdata=$Wall->Comment_Unlike($com_id,$uid);	
}
echo $cdata;
}
?>
