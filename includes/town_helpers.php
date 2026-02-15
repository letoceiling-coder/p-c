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
        // Пытаемся получить town из глобального контекста или создать новый
        try {
            $GLOBALS['APP_TOWN'] = TownResolver::resolve();
        } catch (Exception $e) {
            // Fallback: возвращаем безопасный массив
            $GLOBALS['APP_TOWN'] = array(
                'id' => 0,
                'city_rus' => 'Анапа',
                'adress' => '',
                'phone' => '8 (999) 637-11-82',
                'domen_city' => 'anapa',
                'rayon' => '',
                'city-rus-rod' => 'Анапе',
                'city-rus-is' => 'Анапы',
                'addresslocality' => 'Анапа',
                'streetaddress' => '',
                'postalcode' => '',
                'cords' => ''
            );
        } catch (Error $e) {
            // Fallback для фатальных ошибок
            $GLOBALS['APP_TOWN'] = array(
                'id' => 0,
                'city_rus' => 'Анапа',
                'adress' => '',
                'phone' => '8 (999) 637-11-82',
                'domen_city' => 'anapa',
                'rayon' => '',
                'city-rus-rod' => 'Анапе',
                'city-rus-is' => 'Анапы',
                'addresslocality' => 'Анапа',
                'streetaddress' => '',
                'postalcode' => '',
                'cords' => ''
            );
        }
    }
    return $GLOBALS['APP_TOWN'];
}

/**
 * Получить основной телефон town
 */
function town_phone()
{
    // Пытаемся получить town из разных источников
    $town = null;
    
    // 1. Из глобального контекста (устанавливается в Route.php)
    if (isset($GLOBALS['APP_TOWN']) && is_array($GLOBALS['APP_TOWN']) && isset($GLOBALS['APP_TOWN']['id'])) {
        $town = $GLOBALS['APP_TOWN'];
    }
    // 2. Из Route instance (для шаблонов)
    elseif (isset($GLOBALS['ROUTE_INSTANCE']) && isset($GLOBALS['ROUTE_INSTANCE']->town) && is_array($GLOBALS['ROUTE_INSTANCE']->town)) {
        $town = $GLOBALS['ROUTE_INSTANCE']->town;
    }
    // 3. Из $this->town в шаблонах (через extract в render)
    elseif (isset($GLOBALS['this']) && isset($GLOBALS['this']->town) && is_array($GLOBALS['this']->town)) {
        $town = $GLOBALS['this']->town;
    }
    // 4. Fallback через town()
    else {
        $town = town();
    }
    
    return isset($town['phone']) && !empty($town['phone']) 
        ? htmlspecialchars($town['phone'], ENT_QUOTES, 'UTF-8') 
        : '8 (999) 637-11-82';
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
