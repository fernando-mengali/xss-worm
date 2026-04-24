<?php
include_once 'includes.php';


if($_GET['username'])
{
$username=$_GET['username'];
include_once 'public.php';

if(empty($profile_uid))
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


	<div style='margin:0px auto; width:860px'>

	<?php include_once 'block_logo_menu.php'; ?>


			<div id='main_left'>

				<?php 
				include_once 'block_profile.php';
				include_once 'block_search.php';
	            include_once 'block_friends_widget.php';?>
			</div>

			<div id="main_right">
		    <?php 
		    $profile='1';
		    include('block_updates.php'); 
		    ?>
		    </div>



	<?php include_once 'block_footer.php';?>
	</div>
	</body>
	</html>
