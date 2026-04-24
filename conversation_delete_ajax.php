 <?php
 //Srinivas Tamada http://9lessons.info
//Load latest update 
include_once 'includes.php';
if(isSet($_POST['c_id']))
{
$c_id=mysql_real_escape_string($_POST['c_id']);
$data=$Wall->Delete_Conversation($uid,$c_id);
echo $data;

}
?>
