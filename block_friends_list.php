<div id="wall_container">
<h4>
<?php if($profile_uid==$uid)
{
echo "Your"; 
} else { 
echo $Wall->UserFullName($username);
}
?> 
Friends.
</h4>
<div id="content">

<?php 
// User Friends List
if(isset($_GET['page']))
{
$page=$_GET['page'];
}
else
{
$page=0;
}
$offset=($page-1)* $rowsPerPage;


$updatesarray=$Wall->Friends_List($profile_uid, $page, $offset, $rowsPerPage) ;

if($updatesarray)
{
 foreach($updatesarray as $data)
 {
 $friend_uid=$data['uid'];
 $friend_username=$data['username'];

$face=$Wall->User_Profilepic($friend_uid,$base_url);
 ?>
<div class="stbody">
<div class="stimg">
<a href='<?php echo $base_url.$friend_username; ?>'><img src="<?php echo $face;?>" class='big_face' alt='<?php echo $friend_username; ?>'/></a>
</div> 
<div class="stfriend">
<div style='padding:10px'>	
<b><a href="<?php echo $base_url.$friend_username; ?>"><?php echo $Wall->UserFullName($friend_username); ?></a></b>

<?php 
$profile_uid=$friend_uid;
include('friend_buttons.php');
?>
</div>
</div>
</div>

 <?php

 }
 }
 else
 {
echo '<h4>No friends added</h4>';
 }


//Next Previous Buttons

if($friend_count > $rowsPerPage)
{

$maxPage = ceil($friend_count/$rowsPerPage);
$self = $_SERVER['PHP_SELF'];
$nav = '';

if ($page > 1)
{
$pagee = $page - 1;
$path=$base_url.'friends/'.$username.'/'.$pagee;
$prev = "<span id=\"prev\" class='nbutton color'> <a href='$path' class='next'><< Prev</a></span> ";
}

if ($page < $maxPage)
{
if($page)
{
$pagee= $page + 1;	
}
else
{
$pagee= $page + 2;	
}
$path=$base_url.'friends/'.$username.'/'.$pagee;
$next = "<span id=\"next\" class='nbutton color'> <a href='$path' class='next'>Next >></a></span> ";	
} 
?>
<div style="padding-top:20px; margin:0px 10px 30px 10px; clear:both">
<?php echo $prev; ?>
<?php echo $next; ?>
</div>
<?php } ?>

</div>
</div>