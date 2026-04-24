<img src='<?php echo $profileface;  ?>' width='230px' />
<div id='count_block'>
<div class='count_inner'>
<a href='<?php echo $base_url.$username; ?>'><b id='update_count'><?php echo $session_update_count; ?></b><br/>
<span class='small_text_upper'>Updates</span>
</a>
</div>
<div class='count_inner count_inner_margin'>
<a href='<?php echo $base_url.'friends/'.$username; ?>'><b><?php echo $session_friend_count ?></b><br/>
<span class='small_text_upper'>Friends</span></a>
</div>
</div>