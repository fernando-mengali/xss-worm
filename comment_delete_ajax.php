 <?php
 //Srinivas Tamada http://9lessons.info
//Load latest update 
include_once 'includes.php';
if(isSet($_POST['com_id']))
{
$com_id=$_POST['com_id'];
$data=$Wall->Delete_Comment($uid,$com_id);
echo $data;

}
?>
