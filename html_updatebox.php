<div id="updateboxarea">
<b>What's up <?php echo $Wall->UserFullName($session_username).'?';?></b>
<textarea name="update" id="update"  ></textarea>
<br />
<div id="webcam_container" class='border'>
<div id="webcam" >
</div>
<div id="webcam_preview">

</div>

<div id='webcam_status'></div>
<div id='webcam_takesnap'>

<input type="button" value=" Take Snap " onclick="return takeSnap();" class="camclick  wallbutton"/>
<input type="hidden" id="webcam_count" />
</div>
</div>
<div  id="imageupload" class="border">
<form id="imageform" method="post" enctype="multipart/form-data" action='message_image_ajax.php'> 
<div id='preview'>
</div>
<div id='imageloadstatus'>
<img src='<?php echo $base_url;?>wall_icons/ajaxloader.gif'/> Uploading please wait ....
</div>
<div id='imageloadbutton'>
<span id='addphoto'>Add Photo:</span> <input type="file" name="photoimg" id="photoimg" />
</div>
<input type='hidden' id='uploadvalues' />
</form>
</div>
<div style="width:100%;clear:both">
<span style="float:right">
<a href="javascript:void(0);" id="camera" title="Upload Image"><img src="wall_icons/cameraa.png" border="0" /></a> 
<a href="javascript:void(0);" id="webcam_button" title="Webcam Snap"><img src="wall_icons/web-cam.png"  border="0"  style='margin-top:5px'/></a>
</span>
<input type="submit"  value=" Update "  id="update_button"  class="update_button wallbutton update_box"/> 
</div>

</div>

<div id='flashmessage'>
<div id="flash" align="left"  ></div>
</div>