<?php
/**
 * Helpers для доступа к данным town в шаблонах
 * PHP 5.6 compatible
 */
defined('VG_ACCESS') or die('ACCESS DENIED');

require_once __DIR__ . '/TownResolver.php';

/**
 * Получить текущий town (массив)
 */
function town()
{
    if (!isset($GLOBALS['APP_TOWN'])) {
        $GLOBALS['APP_TOWN'] = TownResolver::resolve();
    }
    return $GLOBALS['APP_TOWN'];
}

/**
 * Получить основной телефон town
 */
function town_phone()
{
    $town = town();
    return isset($town['phone']) ? htmlspecialchars($town['phone'], ENT_QUOTES, 'UTF-8') : '8 (999) 637-11-82';
}

/**
 * Получить массив телефонов town (если есть несколько)
 */
function town_phones()
{
    $town = town();
    $phones = array();
    
    if (!empty($town['phone'])) {
        $phones[] = htmlspecialchars($town['phone'], ENT_QUOTES, 'UTF-8');
    }
    
    // Если есть phone2 (если добавится в будущем)
    if (!empty($town['phone2'])) {
        $phones[] = htmlspecialchars($town['phone2'], ENT_QUOTES, 'UTF-8');
    }
    
    return $phones;
}

/**
 * Получить адрес town
 */
function town_address()
{
    $town = town();
    return isset($town['adress']) ? htmlspecialchars($town['adress'], ENT_QUOTES, 'UTF-8') : '';
}

/**
 * Получить город town
 */
function town_city()
{
    $town = town();
    return isset($town['city_rus']) ? htmlspecialchars($town['city_rus'], ENT_QUOTES, 'UTF-8') : 'Анапа';
}

/**
 * Получить регион town
 */
function town_region()
{
    $town = town();
    return isset($town['rayon']) ? htmlspecialchars($town['rayon'], ENT_QUOTES, 'UTF-8') : '';
}

/**
 * Получить ID town
 */
function town_id()
{
    $town = town();
    return isset($town['id']) ? (int)$town['id'] : 0;
}

/**
 * Получить поддомен town
 */
function town_subdomain()
{
    $town = town();
    return isset($town['domen_city']) ? htmlspecialchars($town['domen_city'], ENT_QUOTES, 'UTF-8') : 'anapa';
}

/**
 * Получить телефон для tel: ссылки (без пробелов и скобок)
 */
function town_phone_clean()
{
    $phone = town_phone();
    // Убираем все кроме цифр и +
    $phone = preg_replace('/[^\d+]/', '', $phone);
    // Если начинается с 8, заменяем на +7
    if (substr($phone, 0, 1) == '8') {
        $phone = '+7' . substr($phone, 1);
    }
    return $phone;
}

/**
 * Получить город в родительном падеже
 */
function town_city_rod()
{
    $town = town();
    return isset($town['city-rus-rod']) ? htmlspecialchars($town['city-rus-rod'], ENT_QUOTES, 'UTF-8') : 'Анапе';
}

/**
 * Получить город в предложном падеже
 */
function town_city_is()
{
    $town = town();
    return isset($town['city-rus-is']) ? htmlspecialchars($town['city-rus-is'], ENT_QUOTES, 'UTF-8') : 'Анапы';
}
