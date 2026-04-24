<?php
$profile_uid=$Wall->User_ID($username);
$UserDetails=$Wall->User_Details($profile_uid);
$friend_count=$UserDetails['friend_count'];
$session_friend_count=$UserDetails['friend_count'];
$session_update_count=$UserDetails['updates_count'];
$profileface=$Wall->User_Profilepic($profile_uid,$base_url);
?>