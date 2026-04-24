<?php
include_once 'includes.php';
include_once 'oauth_redirection.php';
$conversation_uid='';
if($_GET['message_username'])
{
	$conversation_usr=$_GET['message_username'];
	$conversation=$Wall->User_ID($conversation_usr);
	if($conversation)
	{
	$conversation_uid=$conversation;
    if($conversation_uid!=$uid)
    {
	$top_c_id=$Wall->Conversation_Insert($uid,$conversation_uid);
    }
	else
	{
		$url=$base_url.'messages.php';
		header("Location:$url");
	//echo "<script>window.location='$url'</script>";
	
    }
	
   }
	else
	{
	$url=$base_url.'404.php';
	header("Location:$url");
	//echo "<script>window.location='$url'</script>";
    }

}

$face=$Wall->User_Profilepic($uid,$base_url);

?>
<!DOCTYPE html>
<html lang='en'>
<head>
 <meta charset="utf-8">
<title>WallScript Version 6.0</title>
<?php include('jslite.php'); ?>
<script type="text/javascript">
function htmlEscape(str) {
    return String(str)
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
}

function list_more(dataString)
{
	$.ajax({
	type: "POST",
	url: "<?php echo $base_url;?>conversation_more_ajax.php",
	data: dataString,
	cache: false,
	success: function(html){
	
		if($.trim(html).length>0)
		{
	 $("#replylist_content").append(html);
	}
	else
	{
		$("#replylist_content").removeClass('conversation_grid').addClass('conversation_grid_block');
	}
	
	 }
	 });
}

function list_more_reply(dataString)
{
	$.ajax({
	type: "POST",
	url: "<?php echo $base_url;?>conversationReply_more_ajax.php",
	data: dataString,
	cache: false,
	success: function(html){
	if($.trim(html).length>0)
	{
	 $("#reply_content").prepend(html);
	}
	else
	{
	$("#reply_content").removeClass('conversationReply_grid').addClass('conversation_grid_blockk');
	}
	
	 }
	 });
}
$(document).ready(function()
{
	$("#reply_content").animate({"scrollTop": $('#reply_content')[0].scrollHeight}, "slow");
	var playlist_content_height = 570;

	$('.conversation_grid').scroll(function(eve){	
	var a=0;
	var s=$(document).height() - playlist_content_height;
    if(s>128)
    {
	s=128;
    }
	if ($('.conversation_grid').scrollTop() >= s){
		
		var ID=$(".conList:last").attr("rel");
		var dataString = 'last_time='+ ID ;
	    if(a == 0){
		list_more(dataString);
		a = 1;	
    	}
		
	}
	});
	
	
	var playlist_contentReply_height = 470;

	$('.conversationReply_grid').scroll(function(eve){	
	var a=0;
	var s=$(document).height() - playlist_contentReply_height;
    
	if ($('.conversationReply_grid').scrollTop() == 0){
		var b=0;
	    var C_ID=$('#cid').val();
		var ID=$(".reply_stbody:first").attr("id");
		var sid=ID.split("stbody"); 
		var New_ID=sid[1];
		var dataString = 'last_time='+ New_ID +'&c_id='+C_ID;
		console.log(dataString);
		
	    if(b == 0){
		list_more_reply(dataString,C_ID);
		b = 1;	
    	}

		
	}

	});
	
	$('#replylist_content').slimScroll({
	        height: playlist_content_height+'px'
	});

	$('#reply_content').slimScroll({
	        height: '440px'
	});
	
	$("span.timeago").livequery(function () { $(this).timeago(); });
	
	$(".reply_button").live("click",function(){
		var A=$('#update').val();
		var B=$('#cid').val();
	     
		var dataString = 'reply='+ A +'&cid='+B;
		    if($.trim(A).length>0)
		    {
			$.ajax({
			type: "POST",
			url: "<?php echo $base_url; ?>conversation_ajax.php",
			data: dataString,
			cache: false,
			beforeSend: function(){$("#flash").html('<img src="wall_icons/ajaxloader.gif"  />'); },
			success: function(html)
			{	
			if(html)
			{
			//var B=$('#cid').val();
			
			if(A.length > 20) 
			{
			A = A.substring(0,17);
			A+='...';
		    }
			
			$('#reply'+B).html("<img src='<?php echo $base_url; ?>wall_icons/send.png'  class='con_send'/>"+htmlEscape(A));
			$('#reply_content').append(html);
			$("#reply_content").animate({"scrollTop": $('#reply_content')[0].scrollHeight}, "slow");
			$('#flash').hide();	
			$('#update').val('');
			$('#update').focus();
          
			}
			else
			{

			}
			}
			});
		}
			return false;
	
	});
	
	// delete update
	$('.reply_stdelete').live('click',function() 
	{
	var ID = $(this).attr("id");
	//var X=$(this).attr("my");
	var dataString = 'c_id='+ ID ;

	jConfirm('Sure you want to delete this conversation? There is NO undo!', '', 
	function(r) 
	{
	if(r==true)
	{
	$.ajax({
	type: "POST",
	url: "<?php echo $base_url; ?>conversation_delete_ajax.php",
	data: dataString,
	cache: false,
	beforeSend: function(){ $("#stbody"+ID).animate({'backgroundColor':'#f2f2f2'},300);},
	success: function(html){
	 
    window.location='<?php echo $base_url; ?>messages.php';
	 }
	 });
	} });
	return false;
	});
});
</script>


</head>
<body>

	<div id='main'>

	<?php include_once 'block_logo_menu.php'; ?>


			<div id='main_left'>
                       <div class="some-content-related-div">
		       <div id="replylist_content" class="conversation_grid">
               
			   <?php 
			if($conversation_uid)
			{
			include('conversation_load_single.php');
			}
			include('conversation_load.php'); ?>
				
				</div>
				</div>
	
			</div>

<div id="main_right" style='background-color:#ffffff;'>
<div class="some-content-related-div">
<div id="reply_content" class='conversationReply_grid'>
<?php 
include('html_conversationReply.php');
        if(empty($Conversation_Updates)){ 
		if($top_c_id)
		{
		$cu=$Wall->UserFullName($conversation_usr);
		echo "<b>Start conversation with ".$cu."</b>";	
		}
		else
		{
		echo "<b>No conversation selected.</b>";
		}
		 }
?>	
</div>
</div>

<?php if($top_c_id) { ?>
<div id="updateboxarea">
<h5>Write a reply...</h5>
<input type="hidden" id="cid" value="<?php echo $top_c_id;?>">
<textarea name="update" id="update" maxlength="200" style="width:524px !important;"></textarea>
<input type="submit" value=" REPLY " id="update_button" class="reply_button wallbutton update_box"/> 
</div>
<?php } ?>
</div>

<?php include_once 'block_footer.php';?>
</div>
</body>
</html>
