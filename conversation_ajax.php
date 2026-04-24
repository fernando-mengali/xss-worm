 <?php
 //Srinivas Tamada http://9lessons.info
//Load latest comment 
include_once 'includes.php';
if(isSet($_POST['reply']) && isSet($_POST['cid']))
{
$reply=mysql_real_escape_string($_POST['reply']);
$cid=mysql_real_escape_string($_POST['cid']);
	$data=$Wall->ConversationReply_Insert($reply,$cid,$uid); 
	if($data)
	{
    include_once 'html_conversationReplycommon.php';
}
}
?>
