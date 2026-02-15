<?php

namespace classed;

 class BaseController
{

    protected $admin = false;
    protected $canonical;

    protected $ajax;

    protected $client;


    protected $ip;

    protected $route;
    protected $sql;
    protected $urlArray;

    protected $town ;
    protected $towns ;
    protected $menu ;
    protected $controller ;
    protected $methods;
    protected $pathTable;
    protected $template;
    protected $cookies;
    protected $path;
    protected $days;
    protected $users;




    protected $settings =[
        'main' =>'mains',
        'default' =>[
            'class'=>'classed\\PageController',
            'methods'=>'defaultPage',
            'table'=>'url',
            'template' => '',
            'town' => 'anapa'
        ],
        'path'=>[
            'gotovye-potolki'=>[
                'id_categories','id_brend','model'
            ]
        ],
        'plugins' => [
            'towns' => true,
            'menu' => true,
            'town' => true,
            'podDomenRedirect' => false
        ],
        'list'=>'list',
        'logoImage' => '/template/client/images/logoCompany/logo.png'
    ];
     use Singleton;
    public function __construct()
    {

         $this->days = $this->days();
    }
     static public function get($property){
         return self::instance()->$property;
     }
    protected function hexColorRGB($hex){

        switch($hex){
            case 'black':
                $hex = '#000000';
                break;
            case 'white':
                $hex = '#ffffff';
                break;
            default:
                $hex = $hex;
                break;
        }
        $rgb = sscanf($hex, "#%02x%02x%02x");
        return $rgb;
    }
    protected function getFeeds(){
        $months = Settings::get('months');
        $yearsOfWork = date('Y')-2013;

        $fileTemplate = 'temp_feed.txt';
        $rss = 'feeds.rss';
        $itemsfeed = 'itemsfeed.txt';
        $templateFeed = "templateFeed.txt";
        $files = file_get_contents($fileTemplate);

        $template = file_get_contents($templateFeed);
        file_put_contents('templateFeed.rss',  $template);

        $image = new ImageCreate();

        $path = $image->create(255,[
            "src"  => TURBO_IMG_TEMPLATE."starts.jpg",
            "size" => 50,
            "top"  => 200,
            "left" => 550,
            "font" => FONTS."RobotoBold/RobotoBold.woff",
            "save" => TURBO_IMG,
            "color" => $this->hexColorRGB('black')
        ],false,"starts.jpg");

        $path = $image->create('руб.',[
            "src"  => TURBO_IMG_TEMPLATE."starts.jpg",
            "size" => 30,
            "top"  => 200,
            "left" => 680,
            "font" => FONTS."RobotoBold/RobotoBold.woff",
            "save" => TURBO_IMG,
            "color" => $this->hexColorRGB('black')
        ],$path,"starts.jpg");

        $path = $image->create(mb_strtoupper("Распродажа до ". date('d', time() + 86400)." ".$months[date('m', time() + 86400)]."."),[
            "src"  => TURBO_IMG_TEMPLATE."starts.jpg",
            "size" => 13,
            "top"  => 265,
            "left" => 530,
            "font" => FONTS."RobotoCondensedBold/RobotoCondensedBold.woff",
            "save" => TURBO_IMG,
            "color" => $this->hexColorRGB('black')
        ],$path,"starts.jpg");


        $cards = $this->sql->query("SELECT `product_card`.*,`url`.`img_count_json` FROM `product_card` LEFT JOIN `url` ON `url`.`name` = `product_card`.`link`");
        $urls = "";
        $items = "";
        $urls_ = "";
        $itemfeeds = "";
        $template = "";
        foreach ($cards as $key=>$value){
            if(strlen($value['price'])>3){
                $path = $image->create($value['price'],[
                    "src"  => TURBO_IMG_TEMPLATE.$value['img_turbo'],
                    "size" => 30,
                    "top"  => 157,
                    "left" => 190,
                    "font" => FONTS."RobotoBold/RobotoBold.woff",
                    "save" => TURBO_IMG,
                    "color" =>$this->hexColorRGB('black')
                ],false,$this->hexColorRGB('black'));
            }else{

                $path = $image->create($value['price'],[
                    "src"  => TURBO_IMG_TEMPLATE.$value['img_turbo'],
                    "size" => 30,
                    "top"  => 157,
                    "left" => 205,
                    "font" => FONTS."RobotoBold/RobotoBold.woff",
                    "save" => TURBO_IMG,
                    "color" =>$this->hexColorRGB('black')
                ],false,$value['img_turbo']);
            }
            $path = $image->create('руб',[
                "src"  => TURBO_IMG_TEMPLATE.$value['img_turbo'],
                "size" => 20,
                "top"  => 157,
                "left" => 285,
                "font" => FONTS."RobotoBold/RobotoBold.woff",
                "save" => TURBO_IMG,
                "color" =>$this->hexColorRGB('black')
            ],$path,$value['img_turbo']);

            file_put_contents($rss, PHP_EOL . 'text', FILE_APPEND);

            $urls  .= "\r\n"."<p class='center'><a href='{URL}/".$value['link']."'>".$value['name']."<span> от ".$value['price']."  рублей</span></a></p>"."\r\n";

            $urls  .= " <p class='center'><a href='{URL}/".$value['link']."'><img src='{URL}/template/globalTemplate/images/turbo/bg/".$value['img_turbo']."' ></a></p>"."\r\n \r\n";
            $price = [];

            $template = file_get_contents('templateFeed.rss');
            if ($value['link']){
                $price[$value['link']] = $value['price'];
                $template = str_replace("{PRICE-".$value['link']."}",$value['price'],$template);
                $template = str_replace("{DATE}",date('r'),$template);
                //$template  = str_replace("{URL}","https://".$_SERVER['HTTP_HOST'],$template);
                $template  = str_replace("{URL}","https://proffi-center.ru",$template);
                file_put_contents('templateFeed.rss',  $template);
            }

            $urls_ = $urls;
            $itemfeed = file_get_contents($itemsfeed);


            $itemfeed = str_replace("{title}",$value['fuul_name'],$itemfeed);
            $itemfeed = str_replace("{link}",$value['link'],$itemfeed);
            $itemfeed = str_replace("{photo}",$value['img_turbo'],$itemfeed);
            $itemfeed = str_replace("{description}",$value['description_turbo'],$itemfeed);
            $gallery = "";
            foreach (json_decode($value['img_count_json'],true) as $k=>$val){
               $gallery .= "<img src='/template/globalTemplate/images/".$val['imgHref']."' >"."\r\n";

            }
            $itemfeed = str_replace("{gallerey}",$gallery,$itemfeed);
            $itemfeed = str_replace("{paragraph}",$value['paragraph_turbo'],$itemfeed);
            $itemfeed = str_replace("{price}",$value['price'],$itemfeed);
            $itemfeed = str_replace("{DATE}",date('r'),$itemfeed);
            //$itemfeed  = str_replace("{URL}","https://".$_SERVER['HTTP_HOST'],$itemfeed);
            $itemfeed  = str_replace("{URL}","https://proffi-center.ru",$itemfeed);
            $itemfeed  = str_replace("Centr","Center",$itemfeed);
            $itemfeeds .= $itemfeed;

        }



        $files  = str_replace("{yearsOfWork}",$yearsOfWork,$files);
        $files  = str_replace("{URLS}",$urls,$files);
        $itemfeeds  = str_replace("{URLS}",$urls,$itemfeeds);
        $itemfeeds  = str_replace("{URL}","https://proffi-center.ru",$itemfeeds);
        //$files  = str_replace("{URL}","https://".$_SERVER['HTTP_HOST'],$files);
        $files  = str_replace("{URL}","https://proffi-center.ru",$files);
        $files  = str_replace("{DATE}",date('r'),$files);
        $files  = str_replace("{TELPHONE}","tel:89996371182",$files);
        $files  = str_replace("{TEL}","8 (999) 637-11-82",$files);

        file_put_contents($rss, "\xEF\xBB\xBF" . $files."\r\n".$itemfeeds."\r\n"." </channel></rss>");


    }

    protected function searchStr($arr,$str){
        foreach ($arr as $key => $item){
            if (array_search($str, $item)){
                return $arr[$key];
            }

        }
        return false;
    }
    protected function brute_force_array($arr){
        $arrays = [];

        foreach ($arr as $key=>$val){

            if ($val['level_menu'] != 0){
                if ($val['level_priority'] == 1 && $arrays[$val['level_menu']]){
                        array_unshift($arrays[$val['level_menu']], $arr[$key]);
                }else{
                    $arrays[$val['level_menu']][] = $arr[$key];
                }
            }

        }
        return $arrays;
    }
    protected function getClient(){

        return $this->sql->query("SELECT `id` FROM `users` WHERE `sess`= '{$_COOKIE['client']}'",'assoc')['id'];
    }
    public function days(){
        $days = array( 1 => 'Понедельник' , 'Вторник' , 'Среда' , 'Четверг' , 'Пятница' , 'Суббота' , 'Воскресенье' );
        return $this->days = date( $days[date( 'N' )] . ' d.m.Y' );
    }
    protected function setCookies(){

        if (!isset($_COOKIE['user'])){
            $_SESSION['user'] = md5($this->ip);
            setcookie("user", md5( $this->ip), time() + SET_COOKIES);
            setcookie("userCount", 1, time() + SET_COOKIES);

        }
        
        $this->cookies = true;
    }
    protected function getAdmin(){
        if ($_SESSION['admin'] || $_COOKIE['admin']){
             $this->admin = true;
        }
    
    }
    protected function getAdminSql($url = false){

        if ($_SESSION['admin']){

            $user = $this->sql->query("SELECT * FROM `users` WHERE `sess` ='{$_COOKIE['admin']}'");
            if ($user){
                $this->admin = $user;

            }
            array_shift($this->urlArray);
            $sql['template'] = 'main';
        }else{
            $sql['template'] = 'authorization';
        }

        return $sql;
    }
    protected function trimredirect($url){
foreach ($url as $key=>$value){
    if (strpos($value, '_')){
        $url[$key] = str_replace('_','-',$value);
         $msg = true;
    }
}
if ($msg){
    return $url;
}else{
    return false;
}

    }
    protected function trimadress($url_str){

        if (strrpos($url_str, '/') === strlen($url_str) - 1 &&
            strrpos($url_str, '/') !== strlen(PATH) - 1) {
            $url_str = rtrim($url_str, '/');
            $msg = true;
        }

        if (preg_match('"//"', $url_str)) {
            $url_str =   str_replace("//","/",$url_str);
            $msg = true;
        }

        if ($url_str[0]=="/" ) {
            $url_str =   substr($url_str, 1);
            $msg = true;
        }
        if ($msg === true){

            $url_str = self::trimadress($url_str);
        }else{
            return  $this->url = $url_str;
        }
    }
    protected function getRoute(){

        if ( $controller = $this->getController()){

                $this->controller = 'classed\\'.ucfirst($controller).'Controller';
                $this->methods = $this->settings['default']['methods'];
                if ($this->urlArray[1]){
                    $this->methods = $this->urlArray[1];

                    if (!method_exists($this->controller,$this->methods)){
                        $this->methods = $this->settings['default']['methods'];
                    }
                }


        }else{
            $this->controller = $this->settings['default']['class'];
            $this->methods = $this->settings['default']['methods'];
            $this->pathTable = $this->settings['default']['table'];
        }
        $controller = $this->controller;
        $method = $this->methods;

        // Создаем экземпляр контроллера и передаем ему свойства
        $controllerInstance = new $controller();
        $controllerInstance->sql = $this->sql;
        $controllerInstance->urlArray = $this->urlArray;
        $controllerInstance->settings = $this->settings;
        $controllerInstance->pathTable = $this->pathTable ?? null;
        $controllerInstance->route = $this->route ?? null;
        
        $this->route = $controllerInstance->$method();
        $this->template = pull_by_key( $this->route, 'template' );//вытаскиваем шаблон

        if ($this->template == 'error'){

            header("HTTP/1.0 404 Not Found");
        }

    }
    protected function redirect($http = false,$code = false,$r = false){

        if($code){

            $codes = [
                '301' => 'HTTP/1.1 301 Moved Permanently',
                '404' => 'HTTP/1.0 404 Not Found'
            ];
            if($codes[$code]) header($codes[$code]);
        }

        if($http) $redirect = $http;
        else $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
        header("Location:".$redirect);

        exit;
    }

    protected function getController($controller = ''){

        foreach ($this->urlArray as $controller){
            if (strpos($controller, '-')){
                $controller = str_replace('-','',$controller);
            }

            $pathController = 'classed/'.ucfirst($controller).'Controller';

            if (file_exists('classed/'.ucfirst($controller).'Controller.php')){
                return $controller;
            }

        }
        return false;

    }

    public function render($path,$vars = []){

        extract ($vars);
        ob_start();

        if(!include('template/'.$path.".php")){
            exit ("Нет такого шаблона  template/".$path.".php");
        }

        return ob_get_clean();

    }
   static public function writeLog($messege, $file = 'log.txt', $event = 'Pault'){

        $dateTime = new \DateTime();

        $str = $event . ': ' . $dateTime->format('d-m-Y G:i:s') . ' - ' . $messege ."\r\n";

        file_put_contents('log/' . $file, $str, FILE_APPEND);

    }
    protected function getSqlShop($url = false){
        $sql = "SELECT * FROM `cards_shop` WHERE id='{$url->methods}'";
        $sql = $url->sql->query($sql);
        return $sql;
    }
    protected function getSqlClient($id,$client = false){
        if ($client)$sql = " AND `id` = $client";
        return $this->sql->query("SELECT * FROM `client` WHERE `user_id` = '$id' $sql");
    }

    protected function getSqlCards($url = false){

        $sql = "SELECT * FROM `{$this->pathTable}` ";


        if ($this->settings["class"] != $this->urlArray[0]){
            array_shift($this->urlArray);
        }

        if ($this->urlArray[0]  || !empty($this->urlArray[0])) {
            if ($this->urlArray[0] == $this->settings['list']){
                $sql .= " WHERE name = '{$this->settings["main"]}' ";
            }else{
                $sql .= " WHERE name = '{$this->urlArray[0]}' ";
            }
        }else{
            $sql .= " WHERE name = '{$this->settings["main"]}' ";
        }



        $sql = $this->sql->query($sql);




        if (count($sql)==1){
            $sql =  $this->str_transformations($sql[0],$this->town);

            if (in_array($this->settings['list'],$this->urlArray)){
                $card = "SELECT * FROM `cards_shop` ";

                if ($this->urlArray[1] == $this->settings['list']){
                    if ($this->urlArray[2]){
                        $x = (int)$this->urlArray[2]*6-6;
                    }else{
                        $x = 0;
                    }
                    $card = "SELECT * FROM `cards_shop` WHERE `categories`=(SELECT `id` FROM `categories` WHERE `name`='{$this->urlArray[0]}') ";
                    $this->countcards = $this->sql->queryCount($card);
                    $card .= " LIMIT ".$x.",6";
                }
                if ($this->urlArray[0] == $this->settings['list']){
                    if ($this->urlArray[1]){
                        $x = (int)$this->urlArray[1]*6-6;
                    }else{
                        $x = 0;
                    }
                    $this->countcards = $this->sql->queryCount($card);
                    $card .= " LIMIT ".$x.",6";
                }


            }else{

                if ( !$this->urlArray[0]){
                    $card = "SELECT * FROM `cards_shop`";
                }else{
                    $card = " SELECT * FROM `cards_shop` WHERE `categories`=(SELECT `id` FROM `categories` WHERE `name`='{$this->urlArray[0]}')";
                }
                if ($this->urlArray[1]){

                    $card .= " AND WHERE `id_razd`=(SELECT `id` FROM `razd` WHERE `name`='{$this->urlArray[1]}')";
                }
                if ($this->urlArray[2] ){
                    $card .= " AND WHERE `id_brend`=(SELECT `id` FROM `brend` WHERE `name`='{$this->urlArray[2]}')";
                }
                if ($this->urlArray[3]){
                    $card .= " AND WHERE `id_model`=(SELECT `id` FROM `model` WHERE `name`='{$this->urlArray[2]}')";

                }
                $this->countcards = $this->sql->queryCount($card);
                $card .= " LIMIT 0,6";
            }


            $card = $this->sql->query($card);
            if ($card){
                $this->cards = dubl_row($card);
            }else{
                $sql["template"] = 'error';
            }

            return $sql;

        }else{

            return $sql = false;
        }

    }
    public function getPlugin(){
        if (is_array($this->settings['plugins'])){
            foreach ($this->settings['plugins'] as $key => $item){
                if ($item){
                    $this->$key = PluginsController::$key();
                }else{
                    PluginsController::$key();
                }

            }

        }
    }
    protected function fopens($text,$data,$newdata){


        $text = str_replace($data,$newdata,$text);
        $text = str_replace('+0000','+0300',$text);
        $text = str_replace('Proffi-center','{company}',$text);
        $filename =  'feed.rss';

        file_put_contents($filename, $text);

    }
    protected function getSql($url = false){

        $sql = "SELECT * FROM `{$this->settings['default']['table']}` ";

        if ($this->pathTable == $this->settings['default']['table']) {
            if ($this->urlArray[0]  || !empty($this->urlArray[0])) {
                $sql .= " WHERE name = '{$this->urlArray[0]}' ";
            }else{
                $sql .= " WHERE name = 'mains' ";
            }
            if (count($this->urlArray)>1) {
                $sql = false;
            }
        }else{
            $sql = "SELECT * FROM `{$this->pathTable}` ";

            if (!$this->urlArray[1]  || empty($this->urlArray[1])) {
                $sql .= " WHERE `name` = 'mains'";

            }
            if (count($this->urlArray)>1) {
                if ($this->urlArray[1] == 'page') {
                    $sql .= "";

                }else{
                    $sql .= " WHERE name = '{$this->urlArray[1]}' ";

                }



            }


        }

        $sql = $this->sql->query($sql,'assoc');




        if ($sql){
            return $sql =  $this->str_transformations($sql,$this->town);

        }
            return  false;


    }

    protected function str_transformations($str,$town){
        if (is_array($str)){
            foreach ($str as $key=>$value){
                $str_[$key] = $this->tr_transformations_go($value,$town) ;
            }
            return $str_;
        }else{

            return $this->tr_transformations_go($str,$town);
        }


    }
    protected function tr_transformations_go($str,$town){

        $str = str_replace('Профи центр','{company}',$str);
        $str = str_replace('Анапе','{town}',$str);
        $str = str_replace('Анапском районе','{rayon}',$str);

        $str = str_replace('{town}',$town["city-rus-rod"],$str);
        $str = str_replace('{company}',COMPANY,$str);
        $str = str_replace('{rayon}',$town["rayon"],$str);
        $str = str_replace('{date}',date(Y)-2013,$str);
        return trim($str);
    }
     static public function getSiteMap(){
         $filename = 'sitemap_.txt';
         $filename2 = 'sitemap.txt';
         $files = file_get_contents($filename);
         $text  = str_replace("{URL}",'https://'.$_SERVER['HTTP_HOST'],$files);
         $text  = str_replace("{date}",date('c',time()),$text);
         file_put_contents($filename2, $text);

    }
    protected function inputData(){

        if (!$this->route["name_title"] || !$this->route["description"] || !$this->route["keywords"]){

            include_once "setting/settingTitle.php";

        }

        if ($this->controller == 'classed\AdminController'){

            include_once "template/globalTemplate/user/head.php";
            // Не показываем header для админ панели


            echo $this->render('admin/'.$this->template,(array)$this );
            include_once "template/globalTemplate/user/footer.php";
        }elseif ($this->controller == 'classed\ClientController'){

                    $head = "head.php";
                    $footer = "footer.php";

            include_once "template/globalTemplate/client/$head";

            echo $this->render('client/'.$this->template,(array)$this );
            include_once "template/globalTemplate/calc/$footer";
        }elseif ($this->controller == 'classed\CalcController'){

            if ($this->route['pathHeadJs']){
                $head = $this->route['pathHeadJs']['head'];
                $footer = $this->route['pathHeadJs']['footer'];

            }else{
                $head = "head.php";
                $footer = "footer.php";
            }


            include_once "template/globalTemplate/calc/$head";

            echo $this->render('calc/'.$this->template,(array)$this );
            include_once "template/globalTemplate/calc/$footer";
        }elseif ($this->controller == 'classed\TestController'){

            echo $this->render($this->pathTable.'/'.$this->template,(array)$this );

        }else{
            include_once "template/globalTemplate/user/head.php";
            include_once "template/globalTemplate/user/header.php";


            echo $this->render($this->pathTable.'/'.$this->template,(array)$this );
            include_once "template/globalTemplate/user/footer.php";
        }

        exit();
    }
    public function translit_file($filename)
    {
        $converter = array(
            'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
            'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
            'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
            'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
            'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
            'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
            'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

            'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
            'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
            'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
            'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
            'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
            'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
            'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
        );

        $new = '';

        $file = pathinfo(trim($filename));
        if (!empty($file['dirname']) && @$file['dirname'] != '.') {
            $new .= rtrim($file['dirname'], '/') . '/';
        }

        if (!empty($file['filename'])) {
            $file['filename'] = str_replace(array(' ', ','), '-', $file['filename']);
            $file['filename'] = strtr($file['filename'], $converter);
            $file['filename'] = mb_ereg_replace('[-]+', '-', $file['filename']);
            $file['filename'] = trim($file['filename'], '-');
            $new .= $file['filename'];
        }

        if (!empty($file['extension'])) {
            $new .= '.' . $file['extension'];
        }

        return $new;
    }
}