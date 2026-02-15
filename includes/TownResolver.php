<?php
/**
 * TownResolver - единая точка определения города по поддомену
 * PHP 5.6 compatible
 */
defined('VG_ACCESS') or die('ACCESS DENIED');

class TownResolver
{
    private static $currentTown = null;
    private static $db = null;
    
    /**
     * Получить текущий HTTP_HOST
     */
    public static function getHost()
    {
        return isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
    }
    
    /**
     * Извлечь поддомен из host
     * msk.proffi-center.ru -> msk
     * proffi-center.ru -> null (основной домен)
     */
    public static function getSubdomainFromHost($host = null)
    {
        if ($host === null) {
            $host = self::getHost();
        }
        
        // Убираем www.
        $host = str_replace('www.', '', $host);
        
        // Разбиваем по точкам
        $parts = explode('.', $host);
        
        // Если частей больше 2, значит есть поддомен
        // proffi-center.ru = 2 части (основной домен)
        // msk.proffi-center.ru = 3 части (поддомен msk)
        if (count($parts) > 2) {
            return strtolower($parts[0]);
        }
        
        return null;
    }
    
    /**
     * Получить town по поддомену из БД
     */
    public static function resolveTownBySubdomain($subdomain, $db = null)
    {
        if ($db === null) {
            if (self::$db === null) {
                require_once __DIR__ . '/../config/config.php';
                require_once __DIR__ . '/../classed/Db.php';
                self::$db = new \classed\Db();
            }
            $db = self::$db;
        }
        
        if (empty($subdomain)) {
            return self::resolveDefaultTown($db);
        }
        
        // Ищем town по domen_city
        $subdomainEscaped = $db->sql->real_escape_string($subdomain);
        $query = "SELECT * FROM `town` WHERE `domen_city` = '{$subdomainEscaped}' LIMIT 1";
        $result = $db->query($query, 'assoc');
        
        if ($result && !empty($result)) {
            return $result;
        }
        
        // Если не найден - возвращаем default
        return self::resolveDefaultTown($db);
    }
    
    /**
     * Получить default town (fallback)
     */
    public static function resolveDefaultTown($db = null)
    {
        if ($db === null) {
            if (self::$db === null) {
                require_once __DIR__ . '/../config/config.php';
                require_once __DIR__ . '/../classed/Db.php';
                self::$db = new \classed\Db();
            }
            $db = self::$db;
        }
        
        // Ищем town с domen_city = 'anapa' (основной домен по умолчанию)
        $query = "SELECT * FROM `town` WHERE `domen_city` = 'anapa' LIMIT 1";
        $result = $db->query($query, 'assoc');
        
        if ($result && !empty($result)) {
            return $result;
        }
        
        // Если anapa не найден - берем первый
        $query = "SELECT * FROM `town` ORDER BY `id` ASC LIMIT 1";
        $result = $db->query($query, 'assoc');
        
        if ($result && !empty($result)) {
            return $result;
        }
        
        // Если вообще нет towns - возвращаем пустой массив с безопасными значениями
        return array(
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
    
    /**
     * Определить текущий town (основной метод)
     */
    public static function resolve($db = null)
    {
        if (self::$currentTown !== null) {
            return self::$currentTown;
        }
        
        $host = self::getHost();
        $subdomain = self::getSubdomainFromHost($host);
        $town = self::resolveTownBySubdomain($subdomain, $db);
        
        self::$currentTown = $town;
        
        return $town;
    }
    
    /**
     * Сбросить кеш (для тестирования)
     */
    public static function reset()
    {
        self::$currentTown = null;
    }
}
