<?php
function htmlcode($orimessage){
$message= preg_replace("/\r\n|\r|\n/", ' ', $orimessage);

$s = array ("<", ">");
$z = array ("&lt;","&gt;");
$final = str_replace($s, $z, $message);

$message=tolink(trim(str_replace("\\n", "<br/>", $final)));
return stripslashes($message);
}
function htmlcode_nolink($orimessage){
$message= preg_replace("/\r\n|\r|\n/", ' ', $orimessage);

$s = array ("<", ">");
$z = array ("&lt;","&gt;");
$final = str_replace($s, $z, $message);

return stripslashes($final);
}
?>