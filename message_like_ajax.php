<?php
 //Srinivas Tamada http://9lessons.info
//Load latest comment 
include_once 'includes.php';

if(isSet($_POST['msg_id']) && isSet($_POST['rel']))
{
$msg_id=$_POST['msg_id'];
$rel=$_POST['rel'];
if($rel=='Like')
{
$cdata=$Wall->Like($msg_id,$uid);	
}
else
{
$cdata=$Wall->Unlike($msg_id,$uid);	
}
echo $cdata;
}
?>
