<?php
$reply=htmlcode($data['reply']);
$username=$data['username'];
$email=$data['email'];
$cuser_id=$data['uid'];
$cr_id=$data['cr_id'];
$utime=$data['time'];
$mtime=date("c", $utime);
$cface=$Wall->User_Profilepic($cuser_id,$base_url);
?>
<div class="reply_stbody" id="stbody<?php echo $cr_id ?>">
<div class="reply_stimg">
<a href="<?php echo $base_url.$username ?>"><img src="<?php echo $cface ?>" class="big_face" alt="<?php echo $Wall->UserFullName($username); ?>"></a>
</div> 

<div class="reply_sttext">
<b><a href="<?php echo $base_url.$username ?>" class="pname"><?php echo $Wall->UserFullName($username); ?></a></b> 
<?php echo $reply;  ?>
<div class="reply_sttime"> <span class="timeago" title="<?php echo $mtime ?>"></span></div> 
</div> 
</div>

