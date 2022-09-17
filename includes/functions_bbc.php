<?php

//Function xrf_bbcode_format
//Use: Converts BBCode inside text to something display-worthy.
function xrf_bbcode_format($string)
{
	$from = array('[b]', '[/b]',   '[i]', '[/i]',
				  '[u]', '[/u]',   '[s]', '[/s]',
				  '[sub]',         '[/sub]',
				  '[sup]',         '[/sup]',
				  '[big]',         '[/big]',
				  '[small]',       '[/small]',
				  '[center]',      '[/center]',
				  '[quote]',       '[/quote]',
				  '[code]',        '[/code]',
				  '[img]',	       '[/img]',
				  '[/size]',       '[/color]',
				  '[/url]',        '[copy/]',
				  '[reg/]',        '[tm/]',
				  '[bull/]');
	$to =   array('<b>', '</b>',   '<i>', '</i>',
				  '<u>', '</u>',   '<s>', '</s>',
				  '<sub>',         '</sub>',
				  '<sup>',         '</sup>',
				  '<big>',         '</big>',
				  '<small>',       '</small>',
				  '<center>',      '</center>',
				  '<blockquote>',  '</blockquote>',
				  '<pre>',         '</pre>',
				  '<img src="',    '" />',
				  '</span>',       '</font>',
				  '</a>',          '&copy;',
				  '&reg;',         '&trade;',
				  '&bull;');
	$string = str_replace($from, $to, $string);
	$string = preg_replace("/\[size=([\d]+)\]/",
		"<span style=\"font-size:$1px\">", $string);
	$string = preg_replace("/\[color=([^\]]+)\]/",
		"<font color='$1'>", $string);
	$string = preg_replace("/\[url\]([^\[]*)<\/a>/",
		"<a href='$1'>$1</a>", $string);
	$string = preg_replace("/\[url=([^\]]*)]/",
		"<a href='$1'>", $string);
	$string = nl2br($string);
	return $string;
}

?>