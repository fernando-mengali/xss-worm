
 <?php
 //Srinivas Tamada http://9lessons.info
//Load latest comment 
include_once 'includes.php';
if(isSet($_POST['lastid']) && isSet($_POST['profile_id']))
{
$lastid=mysql_real_escape_string($_POST['lastid']);
$profile_uid=mysql_real_escape_string($_POST['profile_id']);
$lastmsg=mysql_real_escape_string($lastmsg);
include('messages_load.php');
}
?>
