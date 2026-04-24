<?php
include_once 'includes.php';

if($_GET['msgID'])
{
$msgID=$_GET['msgID'];
$username=$_GET['username'];
$msgid=$Wall->Status_ID($msgID);
if(empty($msgid))
{
//header('Location:404.php');
}
}
else
{
header('Location:404.php');
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
 <meta charset="utf-8">
<title>WallScript Version 6.0</title>
<?php 
include_once 'js.php';
?>
</head>
<body>


<div id="wall_container">


<div style='clear:both'/>



<div id="content">

<?php 
// Loading Status Message
include('message_status_load.php'); 
?>

</div>
</div>

</body>
</html>
