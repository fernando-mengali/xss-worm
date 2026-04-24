<?php
$msg_id=$data['msg_id'];
$orimessage=$data['message'];
$message=$orimessage;
$time=$data['created'];
$mtime=date("c", $time);
$username=$data['username'];
$uploads=$data['uploads'];
$msg_uid=$data['uid_fk'];
$like_count=$data['like_count'];
$comment_count=$data['comment_count'];
$share_uid=$data['share_uid'];
$share_ouid=$data['share_ouid'];
$share_count=0;
$shareKey=0;
$omsg_id=$msg_id;
if($share_uid!=$share_ouid)
{
$share_count=$data['share_count'];
$omsg_id='s'.$msg_id;
$shareKey=1;
}
$share_uid=$data['share_uid'];
$share_ouid=$data['share_ouid'];
$style='';
$border='';
if($share_ouid>0)
{
$style='margin-top:40px;';
$border='border:solid 1px #006699';
$datanew=$Wall-> User_Details($share_ouid);
$username=$datanew['username'];
}

$like=$Wall->Like_Check($msg_id,$uid);
if($like)
{
	$like_status='Like';
}
else
{
	$like_status='Unlike';
}

$share=$Wall->Share_Check($msg_id,$uid);
if($share)
{
	$share_status='Share';
}
else
{
	$share_status='Unshare';
}


/* User Avatar*/
$face=$Wall->User_Profilepic($msg_uid,$base_url);
/* End Avatar */

if($share_count>0)
{
$shareuid=$Wall->Share_Msg($msg_id);
if($shareuid)
{
$datanew=$Wall->User_Details($shareuid);
$susername=$datanew['username'];
}
}

 ?>
<div class="stbody" id="stbody<?php echo $omsg_id;?>">
<div class="stimg" style="<?php echo $style; ?>">
<a href='<?php echo $base_url.$username; ?>'><img src="<?php echo $face;?>" class='big_face' alt='<?php echo $Wall->UserFullName($username); ?>' style='<?php echo $border; ?>' original-title='<?php echo $Wall->UserFullName($username); ?>'/></a>
<?php if(strlen($border)>0)
{
$sface=$Wall->User_Profilepic($shareuid,$base_url);
$datanew=$Wall->User_Details($shareuid);
$susername=$datanew['username'];
?>
<a href='<?php echo $base_url.$susername; ?>'><img src="<?php echo $sface;?>" class='big_face' alt='<?php echo $Wall->UserFullName($susername); ?>' original-title='<?php echo $Wall->UserFullName($susername); ?>' /></a>
<?php } ?>
</div> 
<div class="sttext">
<?php
if($share_count>0)
{
echo "<div class='sttext_share'>";
if($shareuid)
{
?>
<a href='<?php echo $base_url.$susername; ?>'><?php echo $Wall->UserFullName($susername); ?></a>
<?php 
}
if($share_count>1)
{
$share_count=$share_count-1;
echo 'and <span id="like_count'.$omsg_id.'" class="numcount">'.$share_count.'</span> other friends shared this. ';
}
else
{
echo 'shared this';
}
echo "</div>";
} 
?>
<div class='sttext_content'>
<?php if($uid==$msg_uid) { ?>
<a class="stdelete" href="#" id="<?php echo $omsg_id;?>" rel="<?php echo $msg_id;?>" title="Delete Update"></a>
<?php } ?>
<b><a href="<?php echo $base_url.$username; ?>"><?php echo $Wall->UserFullName($username);?></a></b><?php echo $message; ?> 
<?php
if($uploads)
{
echo '<div class="img_container slider-wrapper"><div class="slider" id="slider'.$omsg_id.'">';
$s = explode(",", $uploads);
$i=1;
$f=count($s);
foreach($s as $a)
{
$newdata=$Wall->Get_Upload_Image_Id($a);
if($newdata)
{
$final_image=$base_url."uploads/".$newdata['image_path'];
echo '<div class="slide'.$i.'" ><img src="'.$final_image.'" class="imgpreview" id="'.$omsg_id.'" rel="'.$msg_id.'"/></div>';
}
$i=$i+1;
}
echo '</div><div class="slider-direction-nav" id="slider_direction_'.$omsg_id.'"></div><div class="slider-control-nav" id="slider_control_'.$omsg_id.'"></div></div>';
if($f>2)
{
echo '<script> $("#slider'.$omsg_id.'").leanSlider({directionNav: "#slider_direction_'.$omsg_id.'",controlNav:"#slider_control_'.$omsg_id.'"}); </script>';
}

}
?>
<div id="stexpandbox">
<div id="stexpand<?php echo $omsg_id;?>">
<?php
if(textlink($orimessage))
{
$link =textlink($orimessage);
$em = new Wall_Expand($link);
$site = $em->get_site();
if($site != "")
{

        $code = $em->get_iframe();
        if($code == "")
        {
                $code = $em->get_embed();
				if($code == "")
				{
				$codesrc=$em->get_thumb("medium");
				}
        }
        if($codesrc)
        {
        echo '<div class="img_container"><img src='.$codesrc.' class="imgpreview" /></div>';
        }
        else if($code)
        echo $code;
}
} 
$codesrc='';
$code='';
?>	
</div>
</div>
<div class='sttime'>
<a href='<?php echo $base_url ?>status/<?php echo $msg_id; ?>' class="timeago" title='<?php echo $mtime; ?>'></a>
</div>
</div>

<div class="sttext_content2">
<div class="st_like_share">
<?php 
if($login)
{
?>
<a href='#' class='like like_button icontext' id='like<?php echo $omsg_id;?>' title='<?php echo $like_status;?>' rel='<?php echo $like_status;?>' data='<?php echo $shareKey ?>'><?php echo $like_status;?></a> 
<a href='#' class='commentopen commentopen_button icontext' id='<?php echo $omsg_id;?>' rel='<?php echo $msg_id;?>' title='Comment'>Comment </a> 
<?php if($uid != $msg_uid) { ?>
<a href='#' class='share share_button icontext' id='share<?php echo $omsg_id;?>' title='<?php echo $share_status;?>' rel='<?php echo $share_status;?>' data='<?php echo $shareKey ?>'><?php echo $share_status;?></a> 
<?php } } else { ?>
<a href='<?php echo $index_url; ?>' class='like icontext' >Like</a> 
<a href='<?php echo $index_url; ?>' class='commentopen icontext'  title='Comment'>Comment </a>
<a href='<?php echo $index_url; ?>' class='share icontext'  title='Share'>Share</a> 	
<?php 	
}
?>


<?php if($like_count>0) 
{ 
$likesuserdata=$Wall->Like_Users($msg_id);
if($likesuserdata)
{
echo '<div class="likes" id="likes'.$omsg_id.'">';
$i=1;
$j=count($likesuserdata);
foreach($likesuserdata as $likesdata)
{
$you="likeuser".$omsg_id;
$likeusername=$likesdata['username'];
if($likeusername == $session_username)
{
$likeusername='You';
$you="you".$omsg_id;
}

echo '<a href="'.$base_url.$likeusername.'" id="'.$you.'">'.$Wall->UserFullName($likeusername).'</a>';
if($j!=$i)
{
echo ', ';
}
$i=$i+1;
}

if($like_count>3)
{
$like_count=$like_count-3;
echo ' and <span id="like_count'.$omsg_id.'" class="numcount">'.$like_count.'</span> others like this.'; 
}
else
{
echo ' like this.'; 
}

echo '</div>';
}
}
else
{
echo '<div class="likes" id="elikes'.$omsg_id.'" style="display:none"></div>';
}
?>
</div> 
<div class="commentcontainer" id="commentload<?php echo $omsg_id;?>">
<?php
$x=1;
include('comments_load.php') ?>
</div>
<div class="commentupdate" style='display:none' id='commentbox<?php echo $omsg_id;?>'>
<div class="stcommentimg">
<img src="<?php echo $session_face;?>" class='small_face'/>
</div> 
<div class="stcommenttext" >
<form method="post" action="">
<textarea name="comment" class="comment" maxlength="200"  id="ctextarea<?php echo $omsg_id;?>"></textarea>
<br />
<input type="submit"  value=" Comment "  id="<?php echo $omsg_id;?>" rel="<?php echo $msg_id;?>" class="comment_button wallbutton"/>
</form>
</div>
</div>
</div> 

        </div>

</div>