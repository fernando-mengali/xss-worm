<?php
ob_start("ob_gzhandler");
error_reporting(0);
include_once 'includes/db.php';
include_once 'includes/User.php';
session_start();
$session_uid=$_SESSION['uid']; 
if(!empty($session_uid))
{
header("location:index.php");
}

$User = new User();

//Login
$login_error='';
if($_POST['user'] && $_POST['passcode'] )
{
$username=$_POST['user'];
$password=$_POST['passcode'];
if (strlen($username)>0 && strlen($password)>0)
{
$login=$User->User_Login($username,$password);

if($login)
{
$_SESSION['uid']=$login;
header("Location:index.php");
}
else
{
$login_error="<span class='error'>Username or Password is invalid</span>";
}
}
}

//Registration
$reg_error='';
if($_POST['email'] && $_POST['username'] && $_POST['password'] )
{
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];

if (strlen($username)>0 && strlen($password)>0 && strlen($email) )
{
$reg=$User->User_Registration($username,$password,$email);

if($reg)
{
$_SESSION['uid']=$reg;
header("Location:index.php");
}
else
{
$reg_error="<span class='error'>Username or Email is already exists.</span>";
}


}
}



?>
<!DOCTYPE html>
<html lang='en'>
<head>
 <meta charset="utf-8">
<title>WallScript Version 6.0</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="js/login.js" type="text/javascript"></script>
<style>

#panel {
border: solid 1px #f2f2f2;
height: 300px;
padding: 20px;
background-color: #e5e5e5;
color:#333;
}
.signup {
margin-left: 6px;
margin-right: 1px;
}
.select {
background-color: #e5e5e5;
}
#label {
font-size: 11px;
}
.input {
font-size: 13px;
color: #333;
height: 28px;
line-height: 22px;
margin: 4px 0px 10px;
padding: 5px 0px 0px 5px;
position: relative;
width: 260px;
border: solid 1px #666;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius:3px;
}
.submit 
{
font-size: 12px;
clear: both;
background-color: #005481;
border: none;
color: #EEE;
cursor: pointer;
font-weight: normal;
text-transform: uppercase;
overflow: visible;
padding: 9px 30px;
text-align: center;
border-top-right-radius: 4px 4px;
border-top-left-radius: 4px 4px;
border-bottom-right-radius: 4px 4px;
border-bottom-left-radius: 4px 4px;
}
body 
{
font-family: Arial, Helvetica, sans-serif;
font: normal 12px helvetica,arial,sans-seri;
font-weight:500;
background-color:#e8e8e8;
}
#button {
margin-top: 10px;
text-align: left;
}
.reg {
font-size: 12px;
clear: both;
background-color: #060;
border: none;
color: white;
cursor: pointer;
font-weight: normal;
text-transform: uppercase;
overflow: visible;
padding: 9px 30px;
text-align: center;
border-top-right-radius: 4px 4px;
border-top-left-radius: 4px 4px;
border-bottom-right-radius: 4px 4px;
border-bottom-left-radius: 4px 4px;
}
.error{color:#cc0000;font-size:11px;display:block}
</style>

</head>

<body>
	<div style='margin:0px auto;width:1000px'>
		<div>
			<img src='wall_icons/blacklogo.png' />
			</div>
<table width='100%'>

<tr>
<td width='50%' valign='top'>
<h4>Login</h4>
<div id="loginbox" >
<form method="post" action="" name="login">
<div id="label">User Name or Email:</div>
<input type="text" name="user" class="input" AUTOCOMPLETE='OFF'/>

<div id="label">Password:</div>
<input type="password" name="passcode" class="input" AUTOCOMPLETE='OFF'/>
<div ><?php echo $login_error; ?></div>
<div>
</div>
<div id="button">
<input type="submit" class="submit" value="LOG IN">
<br/><br/><br/>
<a href='facebook_login.php'><img src='oauthimages/FacebookLogin.png' /></a>
<br/><br/>
<a href='google_login.php'><img src='oauthimages/GoogleLogin.png' /></a>
<br/><br/>
<a href='microsoft_login.php'><img src='oauthimages/MicrosoftLogin.png' /></a>
<br/><br/>
<a href='linkedin_login.php'><img src='oauthimages/LinkedinLogin.png' /></a>

</div>

</form>

</div>
</td>
<td width='50%' valign='top'>
<h4>Registration</h4>
<div id="regbox" style='width:300px' >
<form method="post" action="" name="reg" id="signup">
<div id="label">Email:</div>
<input type="text" name="email" id="email" class="input" AUTOCOMPLETE="OFF" />
<div id="estatus"></div>
<div id="label">User Name:</div>
<input type="text" name="username" id="username" class="input" AUTOCOMPLETE='off' />
<div id="status"></div>
<div id="label">Password:</div>
<input type="password" name="password" id="password" class="input" AUTOCOMPLETE="OFF" />
<div ><?php echo $reg_error; ?></div>
<div id="button">
<input type="submit" class="reg" value="CREATE">
</div>

</form>
</div>

</td>
</tr></table>
</div>
</body>
</html>
