<?php



defined('VG_ACCESS') or die('ACCESS DENIED');

define('SET_COOKIES', 3600*24*30);
define("PRICEBANER",205);


define("DB_HOST",'localhost');
define("DB_USER",'dsc23ytp_kond');

define("DB_PASSWORD",'V7*rrdMr');
define("DB_NAME",'dsc23ytp_kond');
define("URL",'/');


define("PATH",'/');
define("TEL",'8 (999) 637-11-82');
define("MAILTO",'info@proffi-center.ru');
define("SECTION",'template/simpleText/');

define("COMPANY","Proffi Center");
define("SITES",$_SERVER['HTTP_HOST'].PATH);
define("SITE",'https://'.$_SERVER['HTTP_HOST']);

define("DOMEN",'https://'.$_SERVER['HTTP_HOST']);
define("IMG","/template/globalTemplate/images/");
define("CSS","/template/globalTemplate/css/");
define("JS","/template/globalTemplate/js/");
define("FONTS","template/globalTemplate/fonts/");
define("TURBO_IMG","template/globalTemplate/images/turbo/bg/");
define("TURBO_IMG_TEMPLATE","template/globalTemplate/images/turbo/templates/");

define("ADMINIMG","/template/globalTemplate/admin/images/");
define("ADMINCSS","/template/globalTemplate/admin/css/");
define("ADMINJS","/template/globalTemplate/admin/js/");

// Telegram Bot Configuration
define("TELEGRAM_BOT_TOKEN", "8281526294:AAGogHDdDETyU3JHq6TyLJjZPlSauarphIo");
define("TELEGRAM_CHAT_ID", ""); // Будет заполнен автоматически при /start
define("TELEGRAM_SECRET", "proffi_center_secret_2026");
define("TELEGRAM_PARSE_MODE", "HTML");