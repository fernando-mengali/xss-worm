<?php
/************************************************************* 
 * This script is developed by Arturs Sosins aka ar2rsawseen, http://webcodingeasy.com 
 * Feel free to distribute and modify code, but keep reference to its creator 
 * 
 * Media Embed class allows you to retrieve information about media like Video or Images 
 * by simply using link or embed code from media providers like Youtube, Myspace, etc. 
 * It can retrieve embeding codes, title, sizes and thumbnails from 
 * more than 20 popular media providers
 * 
 * For more information, examples and online documentation visit:  
 * http://webcodingeasy.com/PHP-classes/Get-information-about-video-and-images-from-link
**************************************************************/
?>
<form action='' method='post'>
<p>Input link or embed code for media: 
	<input type='text' name='media' size='55'<?php
	if(isset($_POST["media"]))
	{
		echo " value='".$_POST["media"]."' ";
	}
	else
	{
		echo " value='http://www.youtube.com/watch?v=xs-rgXUu448' ";
	}
	?>/> 
	<input type='submit' value='Get info'/>
</p>
</form>
<?php
if(isset($_POST["media"]))
{
	include("includes/Wall_Expand.php");
	$em = new Wall_Expand($_POST["media"]);
	$site = $em->get_site();
	if($site != "")
	{
		echo "<h3>Getting information from ".$site."</h3>";
		echo "<table border='1' cellpadding='10'>";
		echo "<tr><td>Title:</td><td>";
		echo $em->get_title()."\n";
		echo "</td></tr>";
		echo "<tr><td>Canonical url:</td><td>";
		echo "<p><a href='".$em->get_url()."' target='_blank'>".$em->get_url()."</a></p>\n";
		echo "</td></tr>";
		echo "<tr><td>Thumbnail small:</td><td>";
		$src = $em->get_thumb();
		if($src != "")
		{
			echo "<img src='".$src."'/>\n";
		}
		echo "</td></tr>";
		echo "<tr><td>Thumbnail medium:</td><td>";
		$src = $em->get_thumb("medium");
		if($src != "")
		{
			echo "<img src='".$src."'/>\n";
		}
		echo "</td></tr>";
		echo "<tr><td>Thumbnail large:</td><td>";
		$src = $em->get_thumb("large");
		if($src != "")
		{
			echo "<img src='".$src."'/>\n";
		}
		echo "</td></tr>";
		echo "<tr><td>Iframe code:</td><td>";
		echo $em->get_iframe()."\n";
		echo "</td></tr>";
		echo "<tr><td>Embed code:</td><td>";
		echo $em->get_embed()."\n";
		echo "</td></tr>";
		echo "<tr><td>Size:</td><td>";
		$size = $em->get_size();
		echo "<p>".$size["w"]." x ".$size["h"]."</p>\n";
		echo "</td></tr>";
		echo "</table>";
	}
	else
	{
		echo "<h3>Cannot get info from this source</h3>";
	}
}
?>