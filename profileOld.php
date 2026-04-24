<?php
include_once 'includes.php';

if($_GET['username'])
{
$username=$_GET['username'];
$profile_uid=$Wall->User_ID($username);
$UserDetails=$Wall->User_Details($profile_uid);
$friend_count=$UserDetails['friend_count'];
if(empty($profile_uid))
{
header('Location:404.php');
}
}
else
{
header('Location:404.php');
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
 <meta charset="utf-8">
<title>WallScript Version 6.0</title>
<?php 
include_once 'js.php';
?>
</head>
<body>


<div id="wall_container">
<?php
echo  '<h3>'.ucfirst($username).' Updates </h3>';
?>

<div id='profile_grid'>
<div style='float:left;width:200px'>
<h4>Friends</h4>
<span class='count'>
<?php 
//Friends Count
echo '<a href="'.$base_url.'friends/'.$username.'">'.$friend_count.'</a>';
?>
</span>
</div>
<div style='float:right;width:200px'>
<?php include('friend_buttons.php'); ?>
</div>
</div>
<div style='clear:both'/>

<?php if($profile_uid==$uid)
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

</body>
</html>
