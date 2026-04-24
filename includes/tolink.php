<?php
function toolink($text){

        $text = " ".$text;
        $text = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
                '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
        $text = eregi_replace('(((f|ht){1}tps://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
                '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
        $text = eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
        '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
        $text = eregi_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4})',
        '<a href="mailto:\\1"  rel="nofollow">\\1</a>', $text);
        return $text;
}

function tolink($text){
$text = " ".$text;
if(preg_match('/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,4}(\/\S*)?/', $text, $url)) {
	$text = preg_replace('/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/','<a href="'.$url[0].'" target="_blank" rel="nofollow">'.$url[0].'</a>', $text);
}
else if(preg_match('(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)',$text,$url)){
	$text = preg_replace('(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)','<a href="http://'.$url[0].'" target="_blank" rel="nofollow">'.$url[0].'</a>', $text);
}

if(preg_match('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4})', $text, $url)) {
$text = preg_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4})','<a href="mailto:'.$url[0].'" rel="nofollow">'.$url[0].'</a>', $text);
}
return $text;
}

?>