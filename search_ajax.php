 <?php
 //Srinivas Tamada http://9lessons.info
//Load latest update 
include_once 'includes.php';

if(isSet($_POST['searchword']))
{
$searchword=$_POST['searchword'];
$updatesarray=$Wall->User_Search($searchword);

if($updatesarray)
{
foreach($updatesarray as $data)
{
	
$uname=$data['username'];

$uid_new=$data['uid'];
// User Avatar
$face=$Wall->User_Profilepic($uid_new,$base_url);

?>
<div class="display_box" align="left">
<a href='<?php echo $base_url.$uname ?>' style='display:block'>
<img src="<?php echo $face; ?>?d=mm&s=30" class='search_face'/>
<?php echo $Wall->UserFullName($uname); ?>&nbsp;<br/>
</a>
</div>
<?php
}
}

}
?>

