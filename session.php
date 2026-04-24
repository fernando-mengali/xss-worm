 <?php
$session_uid=$_SESSION['uid']; 
// Session Private
if(!empty($session_uid))
{
$uid=$session_uid;
$login='1';
}
else if($_GET['username'] || $_GET['msgID'])
{
$uid=$Wall->User_ID($username);
$login='0';
}
else
{
$url=$base_url.'login.php';
header("location:$url");
}

?>
