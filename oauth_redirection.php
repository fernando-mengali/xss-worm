<?php

//Oauth User Login
$usernameOauth=$Wall->usernameCheck($uid);
if(empty($usernameOauth))
{
$username=$base_url.'username.php';
header("location:$username");
}

?>