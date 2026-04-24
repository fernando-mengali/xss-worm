<div id='header'>
<img src='<?php echo $base_url;?>wall_icons/blacklogo.png'/>
<span style='float:right'>
<ul id='nav'>
<?php if($login) { ?>
<li><a href="<?php echo $index_url; ?>">Home</a></li>
<li><a href="<?php echo $base_url.$session_username; ?>">Profile</a></li>
<li><a href="<?php echo $base_url.'friends/'.$session_username; ?>">Friends</a></li>
<li>
<?php if($session_conversation_count>0) {
echo "<span id='conversation_count'>$session_conversation_count</span>";
} ?>
<a href="<?php echo $base_url.'messages.php'; ?>">Messages</a></li>
<li><a href="<?php echo $base_url.'settings.php'; ?>">Setting</a></li>
<li><a href="<?php echo $base_url.'logout.php'; ?>">Logout</a></li>
<?php } else { ?> 
<li><a href="<?php echo $index_url; ?>">Login</a></li>
<li><a href="<?php echo $index_url; ?>">Sign Up</a></li>		
<?php	} ?>
</ul>
</span>
</div>