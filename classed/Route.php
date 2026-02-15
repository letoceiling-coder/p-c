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
            // Временно отключено для диагностики
            try {
                require_once __DIR__ . '/../includes/TownResolver.php';
                require_once __DIR__ . '/../includes/town_helpers.php';
                
                // Определяем town по поддомену
                $resolvedTown = TownResolver::resolve($this->sql);
                
                // Устанавливаем в глобальный контекст
                $GLOBALS['APP_TOWN'] = $resolvedTown;
                
                // Устанавливаем в Route для совместимости со старым кодом
                $this->town = $resolvedTown;
            } catch (Exception $e) {
                // Fallback: используем старый механизм
                error_log('TownResolver error: ' . $e->getMessage());
                $this->town = null;
            } catch (Error $e) {
                // Fallback: используем старый механизм
                error_log('TownResolver fatal error: ' . $e->getMessage());
                $this->town = null;
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