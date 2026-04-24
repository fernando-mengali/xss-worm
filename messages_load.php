 <?php
//Srinivas Tamada http://9lessons.info
//Loading Comments link with load_updates.php 
if($lastid=='')
{
$lastid=0;
}

//Status Message Check
if($statusMsgID)
{
$updatesarray=$Wall->Updates($profile_uid,$lastid);
$total=$Wall->Total_Updates($profile_uid);
}
else
{

//Profile Page Check
if($profile_uid)
{
$updatesarray=$Wall->Updates($profile_uid,$lastid);
$total=$Wall->Total_Updates($profile_uid);
}
//Home Page Feed
else
{
$updatesarray=$Wall->Friends_Updates($uid,$lastid);
$total=$Wall->Total_Friends_Updates($uid);
}
}

if($updatesarray)
{
foreach($updatesarray as $data)
{
include("html_messages.php");
}


if($total>$perpage)
{
  ?>
 <!-- More Button here $msg_id values is a last message id value. -->
<?php 
$link=$index_url;
$class='';
if($login){
$link='#';
$class='more';	
} 
?>
 
<div id="more<?php echo $msg_id; ?>" class="morebox">
<a href="<?php echo $link; ?>" class="<?php echo $class; ?> ee" id="<?php echo $msg_id; ?>" rel='<?php echo $profile_uid ?>'>More</a>
</div>

  <?php
  }
  }
else
{
echo '<h3 id="noupdates">No Updates</h3>';
}
?>