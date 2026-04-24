<?php
//Srinivas Tamada http://9lessons.info
//Loading Comments link with load_updates.php 
 $commentsarray=$Wall->Comments($msg_id,0);
 
 if($x)
 {
 $comment_count=count($commentsarray);
$second_count=$comment_count-2;
if($comment_count>2)
{
?>
<div class="comment_ui" id="view<?php echo $omsg_id; ?>">
<?php 
$link=$index_url;
$class='';
if($login){
$link='#';
$class='view_comments';	
} 
?>
<a href="<?php echo $link; ?>" class="<?php echo $class ?>" id="<?php echo $omsg_id; ?>" rel="<?php echo $msg_id; ?>" vi='<?php echo $comment_count; ?>'>View all <?php echo $comment_count; ?> comments</a>

</div>
<?php
$commentsarray=$Wall->Comments($msg_id,$second_count);
}
}
if($commentsarray)
{
foreach($commentsarray as $cdata)
{
 
include('html_comments.php');
}
}
?>