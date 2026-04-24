
 <?php
 //Srinivas Tamada http://9lessons.info
//Load latest comment 
include_once 'includes.php';
if(isSet($_POST['lastid']))
{
$lastid=mysql_real_escape_string($_POST['lastid']);
$profile_uid=mysql_real_escape_string($_POST['profile_uid']);
include('messages_load_timeline.php');
}
?>
