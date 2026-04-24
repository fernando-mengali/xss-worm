<div class="small_title">Connections</div>
<?php

if($profile_uid)
{
$friendslist=$Wall->Friends_List($profile_uid,'', '', 35);
}
else
{
$friendslist=$Wall->Friends_List($uid,'', '', 35);
}
if($friendslist)
{
foreach($friendslist as $f)
{
$fid=$f['uid'];
$fname=$f['username'];
$friend_face=$Wall->User_Profilepic($fid,$base_url);
echo '<a href="'.$base_url.$fname.'" ><img src="'.$friend_face.'" class="small_face" original-title="'.$Wall->UserFullName($fname).'" ></a>';
}
}
if($session_friend_count>30)
{
?>
<div><a href="<?php echo $base_url.'friends/'.$username; ?>" class="link">View All</a></div>
<?php } ?>