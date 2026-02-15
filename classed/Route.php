<?php

namespace classed;



class Route extends BaseController
{

    use Singleton;

    public function __construct()
    {

        //define('BASEPATH', str_replace('\\', '/', dirname(__FILE__)) . '/');
        if (! extension_loaded('gd')) { // Проверяем установку библиотеки GD
            echo 'GD не установлено. Обратитесь к администратору вашего сайта!';
            exit;
        }

//        print_r(date('r'));
        //print_r(date('c',time()));

/////ajax/////
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $this->ajax = new AjaxController();
        }
/////end ajax/////


        $adress_str = $_SERVER['REQUEST_URI'];

        if (strrpos($adress_str,'/') === strlen($adress_str) - 1 && strrpos($adress_str,'/') !==  0){
            $this->redirect(rtrim($adress_str,'/'),301);
        }
        $path = substr($_SERVER['PHP_SELF'], 0 , strpos($_SERVER['PHP_SELF'], 'index.php'));

        if ($path == PATH) {

            $this->sql = new Db();
            //$this->getFeeds();

            $this->ip = $_SERVER['REMOTE_ADDR'];
            $this->setCookies();

            $this->datatime = date("r");//Fri, 10 Jun 2022 19:30:28

            // ИНИЦИАЛИЗАЦИЯ TOWN ПО ПОДДОМЕНУ (ШАГ 3)
            // Используем улучшенный старый механизм с поддержкой поддоменов
            $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
            $host = str_replace('www.', '', $host);
            $parts = explode('.', $host);
            
            // Если есть поддомен (больше 2 частей)
            if (count($parts) > 2 && !empty($parts[0])) {
                $subdomain = strtolower($parts[0]);
                // Ищем town по поддомену
                if (isset($this->sql->sql) && is_object($this->sql->sql)) {
                    $subdomainEscaped = $this->sql->sql->real_escape_string($subdomain);
                    $townQuery = "SELECT * FROM `town` WHERE `domen_city` = '{$subdomainEscaped}' LIMIT 1";
                    $townResult = $this->sql->query($townQuery, 'assoc');
                    if (is_array($townResult) && !empty($townResult) && isset($townResult['id'])) {
                        $this->town = $townResult;
                        $GLOBALS['APP_TOWN'] = $townResult;
                    }
                }
            } else {
                // Основной домен - ищем town с domen_city = 'anapa' или первый
                if (isset($this->sql->sql) && is_object($this->sql->sql)) {
                    $townQuery = "SELECT * FROM `town` WHERE `domen_city` = 'anapa' LIMIT 1";
                    $townResult = $this->sql->query($townQuery, 'assoc');
                    if (!is_array($townResult) || empty($townResult) || !isset($townResult['id'])) {
                        // Если anapa не найден - берем первый
                        $townQuery = "SELECT * FROM `town` ORDER BY `id` ASC LIMIT 1";
                        $townResult = $this->sql->query($townQuery, 'assoc');
                    }
                    if (is_array($townResult) && !empty($townResult) && isset($townResult['id'])) {
                        $this->town = $townResult;
                        $GLOBALS['APP_TOWN'] = $townResult;
                    }
                }
            }
            
            // Если town не определен - устанавливаем безопасный fallback
            if (!isset($this->town) || !is_array($this->town) || !isset($this->town['id'])) {
                $this->town = array(
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
                $GLOBALS['APP_TOWN'] = $this->town;
            }

            $this->urlArray = explode('/',substr($adress_str,strlen(PATH)));
            $this->canonical = $adress_str;

           $this->getRoute();

          // $this->getFeeds();


             $this->inputData();



            ////////////////////////////////////////////////////
        }else{
            $this->writeLog('Not path');

        }
    }
}