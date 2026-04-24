<?php
include_once 'includes/db.php';
$q=mysql_query("select * from users");
while($v=mysql_fetch_array($q))
{
	$uid= $v['uid'];
	$z=mysql_query("select * from messages where uid_fk='$uid'");
	$c=mysql_num_rows($z);
	
	mysql_query("UPDATE users SET updates_count='$c' where uid='$uid' ");
}
?>