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
        
        // Проверяем что результат - массив и не пустой
        if (is_array($result) && !empty($result) && isset($result['id'])) {
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
        
        // Проверяем что $db и $db->sql существуют
        if (!is_object($db) || !isset($db->sql) || !is_object($db->sql)) {
            return self::getSafeFallbackTown();
        }
        
        // Ищем town с domen_city = 'anapa' (основной домен по умолчанию)
        try {
            $query = "SELECT * FROM `town` WHERE `domen_city` = 'anapa' LIMIT 1";
            $result = $db->query($query, 'assoc');
            
            // Проверяем что результат - массив и не пустой
            if (is_array($result) && !empty($result) && isset($result['id'])) {
                return $result;
            }
        } catch (Exception $e) {
            // Игнорируем ошибку
        } catch (Error $e) {
            // Игнорируем фатальную ошибку
        }
        
        // Если anapa не найден - берем первый
        try {
            $query = "SELECT * FROM `town` ORDER BY `id` ASC LIMIT 1";
            $result = $db->query($query, 'assoc');
            
            // Проверяем что результат - массив и не пустой
            if (is_array($result) && !empty($result) && isset($result['id'])) {
                return $result;
            }
        } catch (Exception $e) {
            // Игнорируем ошибку
        } catch (Error $e) {
            // Игнорируем фатальную ошибку
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
        
        // Если $db не передан, пытаемся создать новый, но только если VG_ACCESS определен
        if ($db === null) {
            if (!defined('VG_ACCESS')) {
                // Если VG_ACCESS не определен, возвращаем безопасный fallback
                return self::getSafeFallbackTown();
            }
            if (self::$db === null) {
                try {
                    require_once __DIR__ . '/../config/config.php';
                    require_once __DIR__ . '/../classed/Db.php';
                    self::$db = new \classed\Db();
                } catch (Exception $e) {
                    return self::getSafeFallbackTown();
                } catch (Error $e) {
                    return self::getSafeFallbackTown();
                }
            }
            $db = self::$db;
        }
        
        try {
            $host = self::getHost();
            $subdomain = self::getSubdomainFromHost($host);
            $town = self::resolveTownBySubdomain($subdomain, $db);
            
            // Проверяем что результат - массив
            if (!is_array($town) || !isset($town['id'])) {
                $town = self::getSafeFallbackTown();
            }
            
            self::$currentTown = $town;
            
            return $town;
        } catch (Exception $e) {
            return self::getSafeFallbackTown();
        } catch (Error $e) {
            return self::getSafeFallbackTown();
        }
    }
    
    /**
     * Безопасный fallback town
     */
    private static function getSafeFallbackTown()
    {
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
     * Сбросить кеш (для тестирования)
     */
    public static function reset()
    {
        self::$currentTown = null;
    }
}
