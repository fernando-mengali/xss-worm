<div id="wall_container">
<?php
$userdetails=$Wall->User_Details($uid);
$username=$userdetails['username'];
$email=$userdetails['email'];
$full_name=$userdetails['full_name'];
$profile_pic=$userdetails['profile_pic'];
$profile_pic_status=$userdetails['profile_pic_status'];
?>
<h3>Settings</h3>
<div class='msg'><?php echo $msg; ?></div>
<form method='post' action='' enctype="multipart/form-data" >
<table width='100%' id='settings'>
<tr>
<td valign='top' class='label'>Username: </td>
<td valign='top'><?php echo $username; ?></td>
</tr>

<tr>
<td valign='top' class='label'>Email: </td>
<td valign='top'><?php echo $email; ?></td>
</tr>

<tr>
<td valign='top' class='label'>Name: </td>
<td valign='top'><input type='text' name='full_name' value='<?php echo $full_name; ?>' maxlength="50"/></td>
</tr>

<tr>
<td valign='top' class='label'>Password:</td>
<td valign='top'><a href='change_password.php'>Change Passsword. </a></td>
</tr>

<tr>
<td valign='top' class='label'>Profile Picture:</td>
<td valign='top'><input type="file" name="photoimg" id="photoimg"/><br/>
<?php echo '<img src="'.$profile_path.$profile_pic.'" style="width:100px; margin:10px 0px 10px 0px"/>'; ?>
</td>
</tr>

<tr>
<td valign='top' class='label'>Avatar:</td>
<td valign='top'>
	<?php 
	if($profile_pic_status) 
	{ 
	$a='checked';
	$b='';
	} 
	else 
	{ 
	$b='checked';
	$a='';
	}

	?>
	<input type='radio' value='0' name='avatar' <?php echo $b; ?> /> Gravatar.com   &nbsp;&nbsp;

	<input type='radio' value='1' name='avatar' <?php echo $a; ?> /> Profile Picture
	
</td>
</tr>

<tr>
<td valign='top'></td>
<td valign='top'><input type='submit' value='Save Settings' class='wallbutton'/></td>
</tr>
</table>
</form>

</div>