<?php
//ob_start("ob_gzhandler");
error_reporting(0);
session_start();
include_once 'includes/db.php';
include_once 'includes/Wall_Updates.php';
include_once 'includes/tolink.php';
include_once 'includes/textlink.php';
include_once 'includes/htmlcode.php';
include 'includes/Wall_Expand.php';
$Wall = new Wall_Updates();
include_once 'session.php';
$session_data=$Wall->User_Details($uid);
$session_username=$session_data['username'];
$username=$session_data['username'];
$session_email=$session_data['email'];
$session_friend_count=$session_data['friend_count'];

$session_conversation_count=$session_data['conversation_count'];
$session_update_count=$session_data['updates_count'];

$session_face=$Wall->User_Profilepic($uid,$base_url);

$profileface=$session_face;

$url404=$base_url.'404.php';
$index_url=$base_url.'login.php';
?>