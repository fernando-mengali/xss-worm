<?php 
if($cupdatesarray)
{
foreach($cupdatesarray as $data)
{
$c_id=$data['c_id'];
$username=$data['username'];
$email=$data['email'];
$cuser_id=$data['uid'];
$maintime=$data['time'];
$cupdatesarray=$Wall->Conversation_List($c_id,$uid);
if($c_id==$top_c_id ) 
{ 
$style='background-color:#a7d8ec';
}
else
{
$style=='';	
}

if($cupdatesarray)
{
foreach($cupdatesarray as $data)
{
$reply=htmlcode_nolink($data['reply']);
//$reply=$data['reply'];

       //Get the lenght of the string.
       $str_length = strlen($reply);       
       
       if($str_length > 25)
       {
          
           	$reply= substr($reply, 0, 25) . "..." ;
           
       }
$reply_uid=$data['user_id_fk'];
$ctime=$data['time'];
$read_status=$data['read_status'];
$mtime=date("c", $ctime);
if($read_status && $reply_uid!=$uid) 
{ 	
$style='background-color:#dedede';
}
else
{
$style=='';	
}

$cface=$Wall->User_Profilepic($cuser_id,$base_url);

?>
<a href="<?php echo $base_url.'messages/'.$username; ?>" class='con_name'>
<div id='<?php echo $c_id; ?>' class='conList' style='<?php echo $style; ?>' rel='<?php echo $maintime; ?>'>
	<span class="reply_stdelete" href="#" id="<?php echo $c_id; ?>" original-title="Delete Update"></span>
<img src='<?php echo $cface; ?>' class='cimg'>

<span class='cname'><?php echo $cu=$Wall->UserFullName($username); ?></span><br/>

<span id='reply<?php echo $c_id ?>' class='reply'>
	
<?php 

if($reply_uid==$uid) { 
	echo "<img src='".$base_url."wall_icons/send.png'  class='con_send'/>";
	}?>	


<?php echo $reply; ?></span><br/>
<span  class="sttime timeago con_time" title="<?php echo $mtime; ?>"></span>
</div></a>
<?php 
} } 		  $style=''; } }