<?php
include_once 'includes.php';
include_once 'oauth_redirection.php';
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
<title><?php echo ucfirst($username); ?> Friends</title>
<link href="<?php echo $base_url; ?>css/wall.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $base_url; ?>js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
// Add button
$('.addbutton').live('click',function() 
{
var vid = $(this).attr("id");
var sid=vid.split("add"); 
var ID=sid[1];
var dataString = 'fid='+ ID ;

$.ajax({
type: "POST",
url: "<?php echo $base_url; ?>friend_add_ajax.php",
data: dataString,
cache: false,
beforeSend: function(){$("#friendstatus").html('<img src="wall_icons/ajaxloader.gif"  />'); },
success: function(html)
{	
if(html)
{
$("#friendstatus").html('');
$("#add"+ID).hide();
$("#remove"+ID).show();
}
}
});
return false;
});

// Remove Friend
$('.removebutton').live('click',function() 
{

var vid = $(this).attr("id");
var sid=vid.split("remove"); 
var ID=sid[1];
var dataString = 'fid='+ ID ;

$.ajax({
type: "POST",
url: "<?php echo $base_url; ?>friend_remove_ajax.php",
data: dataString,
cache: false,
beforeSend: function(){$("#friendstatus").html('<img src="wall_icons/ajaxloader.gif"  />'); },
success: function(html)
{	
if(html)
{
$("#friendstatus").html('');
$("#remove"+ID).hide();
$("#add"+ID).show();
}
}
});
return false;
});

$("#searchinput").keyup(function() 
{
var searchbox = $(this).val();
var dataString = 'searchword='+ searchbox;

if(searchbox.length>0)
{

$.ajax({
type: "POST",
url: "<?php echo $base_url; ?>search_ajax.php",
data: dataString,
cache: false,
success: function(html)
{
$("#display").html(html).show();
}
});
}return false; 
});

$("#display").mouseup(function() 
{
return false
});

$(document).mouseup(function()
{
$('#display').hide();
$('#searchinput').val("");
});



});
</script>
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
		   
		    include('block_friends_list.php'); 
		    ?>
		    </div>



	<?php include_once 'block_footer.php';?>
	</div>


</body>
</html>
