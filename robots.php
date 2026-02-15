<?php

header('Content-type: text/plain');

$host = $_SERVER['HTTP_HOST']; // www.site.ru или site.ru

$host = str_replace(array("www."), "", $host); // www.site.ru => site.ru , site.ru останется как site.ru
//$host = "www.".$host; // site.ru => www.site.ru
print_r("# Robots.txt for ".$host); print_r("\n"); // # Robots.txt for www.site.ru

$common_disallows = "
Allow: /
Disallow: /cgi-bin
Disallow: /admin/
Disallow: /client/
";

print_r("User-agent: *");
print_r($common_disallows);
print_r("Host: ".$host); print_r("\n");


print_r("Sitemap: https://".$host."/sitemap.xml"); print_r("\n");

?>




