 <?php
//Srinivas Tamada http://9lessons.info

//Status Message Check

if($msg_id)
{
$updatesarray=$Wall->Status_Update($msg_id);
}

if($updatesarray)
{
foreach($updatesarray as $data)
 {
include("html_messages.php");

  }
  }
?>