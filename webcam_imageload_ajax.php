 <?php
 //Srinivas Tamada http://9lessons.info
//Load latest update 
include_once 'includes.php';
if(isSet($_POST['webcam']))
{
$newdata=$Wall->Get_Upload_Image($uid,0);
echo "<img src='uploads/".$newdata['image_path']."'  class='webcam_preview' id='".$newdata['id']."'/>";
}
?>
