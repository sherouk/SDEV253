<?php

$url = "http://www.sdev253.net/home.html";
$domain = str_ireplace('www.', '', parse_url($url, PHP_URL_HOST));

print "The domain name is {$domain}"

?>

<!-- I realize this isn't using preg_match() but I ran into trouble 
finding the section in the book as the pages aren't numbered and 
figured out a simpler method -->