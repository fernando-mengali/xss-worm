<div id="wall_container">

<?php

if($profile)
{		
include('friend_buttons.php');	

if($friend_status!='me')
{
?>
<span class="message">
<a href="<?php echo $base_url.'messages/'.$username;?>"  class='wallbutton'>Message</a>
</span>
<?php
}
echo  '<h3>'.$Wall->UserFullName($username).'&rsquo;s Updates </h3>';
}
else
{
echo "<h3>News Feed</h3>";
}	 


if($profile_uid==$uid || $home)
{
include_once('html_updatebox.php');
}

?>


<div id="content">
<?php 
// Loading Messages
include('messages_load.php'); 
?>
</div>
</div>