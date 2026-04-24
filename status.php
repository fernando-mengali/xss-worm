<?php
include_once 'includes.php';
if($_GET['msgID'])
{
$msg_id=$_GET['msgID'];
$username=$Wall->Status_User($msg_id);
include_once 'public.php';
$msgid=$Wall->Status_ID($msg_id);

if(empty($msg_id))
{

header("Location:$url404");
}
}
else
{
header("Location:$url404");
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

<div id='main'>

<?php include_once 'block_logo_menu.php'; ?>


		<div id='main_left'>
			
			<?php 
			include_once 'block_profile.php';
			include_once 'block_search.php';
            include_once 'block_friends_widget.php';?>
		</div>
	
		<div id="main_right">
	   <?php 
// Loading Status Message
include('message_status_load.php'); 
?>
	    </div>



<?php include_once 'block_footer.php';?>
</div>
</body>
</html>

