<?php
if($last=='')
{
$last=0;
}

$Conversation_Updates=$Wall->Conversation_Updates($top_c_id,$uid,$last,$conversation_uid);
if($Conversation_Updates)
{
foreach($Conversation_Updates as $data)
{

include 'html_conversationReplycommon.php';
} }	?>

