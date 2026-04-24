<?php
include_once 'includes.php';
$error_msg='';
if($_SERVER["REQUEST_METHOD"] == "POST")
{

	if (strlen($_POST['username'])>0)
	{
	$username=mysql_real_escape_string($_POST['username']);
	$usernameUpdate=$Wall->usernameUpdate($uid,$username);
	
	if($usernameUpdate)
	{
		$home=$base_url.'index.php';
		header("location:$home");
		//echo "<script>window.location.href='".$home."'</script>";
		
	}
	else
	{
	$error_msg="Username already exists, please give another username";	
	}
   }
}

?>
<!DOCTYPE html>
<html lang='en'>
<head>
 <meta charset="utf-8">
<title>WallScript Version 6.0</title>
<?php include('jslite.php'); ?>
<script type="text/javascript" src="js/jquery.validate.js" ></script>
<script type="text/javascript">
$(document).ready(function()
{
	$.flag=0;
$("#username").keyup(function() 
{ 

var username = $(this).val();
var msgbox = $("#status");

if($.trim(username).length >= 3)
{
$("#status").html('Checking availability...');

$.ajax({  
    type: "POST",  
    url: "check_username.php",  
    data: "username="+ username,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 
   
   var d = msg;
var str=msg.substr(0, 2);

    
	if(str == 'OK')
	{ 
	    $("#username").removeClass("no");
	    $("#username").addClass("yes");
	    $.flag=1;
        msgbox.html('<font color="Green"> Available </font>');
	}  
	else  
	{  
	     $("#username").removeClass("yes");
		 $("#username").addClass("no");
		$.flag=0;
		msgbox.html(msg);
	}  
   
   });
   } 
   
  }); 

}
else
{
 $("#username").addClass("no");
$("#status").html('<font color="#cc0000">Enter valid User Name</font>');
}
return false;
});

     
	 $.validator.addMethod("username",function(value,element){
    return this.optional(element) || /^[a-zA-Z0-9_-]{3,16}$/i.test(value);  
    },"Username are 3-15 characters no spaces");


    
        // Validate signup form
        $("#usernamesave").validate({
               	rules: {
                     
		         	username: "required username",
                      

               },

        });
		
		

});
</script>
<style>
.error{color:#cc0000;font-size:12px}
#status{font-size:12px}
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
	    	<div id="wall_container">

			<div id="updateboxarea">
			<h4>Please Give Username?</h4><br/>
			<form method='post' action='' id='usernamesave'>
			<input type='text' name='username' id='username' class='required username' style="padding:4px;border:solid 1px #666666" autocomplete="off"/><br/>
			<span id="status"><?php echo $error_msg; ?></span><br/>
			<input type='submit' value=' Save '  />	
			</form>

			</div>
			</div>
	    </div>
<?php include_once 'block_footer.php';?>
</div>
</body>
</html>