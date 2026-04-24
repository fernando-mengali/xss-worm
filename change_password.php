<?php
include_once 'includes.php';

$msg='';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$oldpassword=$_POST['oldpassword'];
$newpassword=$_POST['newpassword'];
$cpassword=$_POST['cpassword'];

if(strlen($oldpassword)>0 && strlen($newpassword)>0 && strlen($cpassword)>0)
{
$password=$Wall->Change_Password($oldpassword, $newpassword, $cpassword,$uid);

	if($password)
	{
	$msg="<span class='succ'>Password changed successfully.</span>";

	}
	else
	{
	$msg="<span class='error'>Please give valid Old Password and Confirm Password.</span>";

	}

}
else
{
$msg="<span class='error'>Please give valid details.</span>";

}
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
<style>
#settings td
{
padding:4px
}
.label
{
text-align:right;
font-weight:bold;
}
.msg
{
text-align:center;
font-size:12px;
}
.error
{
color:#cc0000;
}
.succ
{
color:#006699
}
</style>
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
		 
		    include('block_changePassword.php'); 
		    ?>
		    </div>



	<?php include_once 'block_footer.php';?>
	</div>

</body>
</html>
