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
            // ВРЕМЕННО ОТКЛЮЧЕНО - используем старый механизм через PluginsController
            // TODO: Включить после полной диагностики проблемы

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