<span class="follow">
<?php 
if($login)
{
$friend_status=$Wall->Friends_Check($uid,$profile_uid); 
$friend_check=$Wall->Friends_Check_Count($uid,$profile_uid);
if($friend_check=='0')
{
?>
<a href="#"  class='wallbutton add-box addbutton' id='add<?php echo $profile_uid; ?>' p='1'>Follow</a>
<a href="#"  class='wallbutton rm-box removebutton'  id='remove<?php echo $profile_uid; ?>' style="display:none" p='1'>Following</a>
<?php
}
else if($friend_status=='me')
{
echo '<b>You!</b>';
}
else if($friend_status=='fri')
{
?>
<a href="#"  class='wallbutton rm-box removebutton'  id='remove<?php echo $profile_uid; ?>' p='1'>Following</a>
<a href="#"  class='wallbutton add-box addbutton'  id='add<?php echo $profile_uid; ?>' style="display:none" p='1'>Follow</a>
<?php } }
else
{
	?>
<a href="<?php echo $index_url; ?>"  class='wallbutton add-box '  p='1'>Follow</a>
<?php 
}
?>
</span>