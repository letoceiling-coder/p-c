<?
ob_start(); // Начинаем буферизацию для подавления warnings
define('VG_ACCESS',true);

header("Content-Type:text/html;charset-UTF-8");
session_start();

require_once 'config/config.php';
require_once 'functions/functions.php';

use classed\Route;
use classed\RouteException;

try{

    $route =  new Route();

}
catch (RouteException $e){

    exit($e->getMessage());
}


