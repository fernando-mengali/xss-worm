<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <?php
 //Srinivas Tamada http://9lessons.info
//Load latest comment 
include_once 'includes.php';
if(isSet($_POST['comment']))
{
$comment=mysql_real_escape_string($_POST['comment']);

$msg_id=$_POST['msg_id'];
$ip=$_SERVER['REMOTE_ADDR'];
$cdata=$Wall->Insert_Comment($uid,$msg_id,$comment,$ip);
if($cdata)
{
include('html_comments.php');
}
}
?>
