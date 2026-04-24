<?php
include_once 'includes.php';
include_once 'oauth_redirection.php';
function getExtension($str) 
{

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];
			$full_name = $_POST['full_name'];
			$p_status=$_POST['avatar'];
			$actual_image_name='';
	
			if(strlen($full_name)>0 && strlen($name))
				{
					 $ext = getExtension($name);
					if(in_array($ext,$valid_formats))
					{
					if($size<(1024*300))
						{
							$actual_image_name = time().$uid.".".$ext;
							$tmp = $_FILES['photoimg']['tmp_name'];
							if(move_uploaded_file($tmp, $profile_path.$actual_image_name))
								{
							
									$settings=$Wall->Update_Settings($full_name,$actual_image_name,$uid,$p_status);
									
									if($settings)
								        {
									
									$msg="<span class='succ'>Successful.</span>";
									
									}

									
								}
							else
							{
							$msg="<span class='error'>Failed.</span>";
							}
						}
						else
						{
						$msg="<span class='error'>Image file size max 300 KB</span>";
						}
						}
						else
						{
						$msg="<span class='error'>Invalid file format.</span>";
						}
				}
				
            else if(strlen($full_name)>0)
			{
				
                                    $settings=$Wall->Update_Settings($full_name,$actual_image_name,$uid,$p_status);
									if($settings)
								    {
								
									$msg="<span class='succ'>Updated. </span>";
									
									}
			}
			else
			{
				$msg="<span class='error'>Please give valid name and image..!</span>";
			}
				
		
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
<style>
#settings td
{
padding:4px
}
.label
{
text-align:right;
font-weight:bold;
}
</style>
</head>
<body>

	<div id='main'>

	<?php include_once 'block_logo_menu.php'; ?>


			<div id='main_left'>

				<?php 
				include_once 'block_profile.php';
				include_once 'block_search.php';
	            include_once 'block_friends_widget.php';?>
			</div>

			<div id="main_right">
		    <?php 
		 
		    include('block_settings.php'); 
		    ?>
		    </div>



	<?php include_once 'block_footer.php';?>
	</div>



</body>
</html>
