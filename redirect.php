<?php
if($result)
{

$_SESSION['userSession']=$result;
$_SESSION['uid']=$result;
$uid=$_SESSION['uid'];


$usernameOauth=$Wall->usernameCheck($uid);
if($usernameOauth)
{
$home=$base_url.'index.php';
echo "<script>window.location.href='".$home."'</script>";
}
else
{
$username=$base_url.'username.php';
echo "<script>window.location.href='".$username."'</script>";	
}

}
?>