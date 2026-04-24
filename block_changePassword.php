<div id="wall_container">
<?php
$userdetails=$Wall->User_Details($uid);
$username=$userdetails['username'];
$email=$userdetails['email'];
$full_name=$userdetails['full_name'];
$profile_pic=$userdetails['profile_pic'];
?>
<h3>Change Password</h3>
<div class='msg'><?php echo $msg; ?></div>
<form method='post' action=''>
<table width='100%' id='settings'>
<tr>
<td valign='top' class='label'>Old Password: </td>
<td valign='top'><input type='password' name='oldpassword' /></td>
</tr>

<tr>
<td valign='top' class='label'>New Passsword: </td>
<td valign='top'><input type='password' name='newpassword'/></td>
</tr>

<tr>
<td valign='top' class='label'>Confirm Password: </td>
<td valign='top'><input type='password' name='cpassword' /></td>
</tr>


<tr>
<td valign='top'></td>
<td valign='top'>

<input type='submit' value='Save' class='wallbutton'/></td>
</tr>
</table>
</form>

</div>
