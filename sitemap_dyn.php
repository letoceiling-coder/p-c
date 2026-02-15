<?php
define('VG_ACCESS',true);
require_once 'config/config.php';
require_once 'functions/functions.php';
use classed\BaseController;
BaseController::getSiteMap();


$file=$_SERVER['SCRIPT_FILENAME'];
$last_modified_time = filemtime($file);
#$etag = md5_file($file);
$etag = $last_modified_time;

header("Last-Modified: ".gmdate('D, d M Y H:i:s', $last_modified_time)." GMT");
header("Etag: ".$etag);

if (strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $last_modified_time ||
    trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) {
    header('HTTP/1.1 304 Not Modified');
    exit();
}


header('Content-Type: application/xml');
echo "<?xml version='1.0' encoding='UTF-8'?>";

include_once 'sitemap.txt';
?>

