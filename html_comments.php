<?php
$com_id=$cdata['com_id'];
//$comment=tolink(htmlentities($cdata['comment'] ));
$comment=htmlcode($cdata['comment'] );
$time=$cdata['created'];
$mtime=date("c", $time);
$username=$cdata['username'];
$com_uid=$cdata['uid_fk'];
$clike_count=$cdata['like_count'];
 // User Avatar
$cface=$Wall->User_Profilepic($com_uid,$base_url);

  // End Avatar
 ?>
<div class="stcommentbody" id="stcommentbody<?php echo $com_id; ?>">
<div class="stcommentimg">
<a href='<?php echo $base_url.$username; ?>'><img src="<?php echo $cface; ?>" class='small_face' alt='<?php echo $Wall->UserFullName($username); ?>' original-title='<?php echo $Wall->UserFullName($username); ?>'/></a>
</div> 
<div class="stcommenttext">
<?php 
if($login)
{
if($uid==$com_uid || $uid==$msg_uid ){ ?>
<a class="stcommentdelete" href="#" id='<?php echo $com_id; ?>' title='Delete Comment'></a>
<?php } } ?>
<b><a href="<?php echo $base_url.$username; ?>"><?php echo $Wall->UserFullName($username); ?></a></b> <?php echo $comment; ?>
<div style='font-size:11px !important'>

<span class="stcommenttime" title="<?php echo $mtime; ?>"></span> - 
<?php 
if($login)
{
if($Wall->Comment_Like_Check($com_id,$uid)) 	
{
echo '<a href="#" id="clike'.$com_id.'" class="commentlike" title="Like" rel="Like">Like</a>';
} else { 
echo '<a href="#" id="clike'.$com_id.'" class="commentlike" title="Unlike" rel="Unlike">Unlike</a>';
}
}
else
{
echo '<a href="'.$index_url.'"  class="commenttlike" >Like</a>';
}
$cstyle='';
if($clike_count==0)
{
$cstyle='display:none';	
}

?>
<span style="<?php echo $cstyle; ?>" id='count_container<?php echo $com_id; ?>'>
 - <span class='comment_count<?php echo $com_id; ?>'><?php echo $clike_count; ?></span> 
</span>
</div>
</div>
</div>