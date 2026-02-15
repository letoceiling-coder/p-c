<?php

namespace classed;

class AdminController extends BaseController
{


    public function __construct(){

    }
    public function defaultPage(){
        // Проверяем авторизацию - проверяем и admin и client cookie (так как используем autz_client)
        if ($_SESSION['admin'] || $_COOKIE['admin']){
            $sess = $_COOKIE['admin'] ?? $_SESSION['admin'];
            $user = $this->sql->query("SELECT * FROM `users` WHERE `sess` ='{$sess}'", 'assoc');
            if ($user){
                $this->admin = $user;
            }
        } elseif ($_SESSION['client'] || $_COOKIE['client']){
            // Если нет admin cookie, проверяем client (так как используем autz_client для админа)
            $sess = $_COOKIE['client'] ?? $_SESSION['client'];
            $user = $this->sql->query("SELECT * FROM `users` WHERE `sess` ='{$sess}'", 'assoc');
            if ($user){
                $this->admin = $user;
            }
        }
        
        // Если не авторизован, показываем форму авторизации
        if (!$this->admin){
            $sql['template'] = 'authorization';
            return $sql;
        }
        
        // Удаляем 'admin' из urlArray (аналогично array_shift в getAdminSql)
        if (!empty($this->urlArray) && $this->urlArray[0] == 'admin'){
            array_shift($this->urlArray);
        }
        
        // Для главной страницы админ-панели возвращаем dashboard
        if (empty($this->urlArray) || empty($this->urlArray[0])){
            $sql['template'] = 'dashboard';
            return $sql;
        }
        
        // Если есть метод в контроллере для этого URL, вызываем его
        $method = $this->urlArray[0];
        if (method_exists($this, $method)){
            return $this->$method();
        }
        
        // Для других страниц используем старую логику
        if (is_array($this->settings['plugins'])){
            foreach ($this->settings['plugins'] as $key => $item){
                if ($item){
                    $this->$key = PluginsController::$key();
                }else{
                    PluginsController::$key();
                }
            }
        }

        $this->pathTable = 'url';
        $sql = $this->getSql();
        if (!$sql && !empty($this->urlArray[0])){
            $pars = end(explode('-',$this->urlArray[0]));
            $pars_ = str_replace(' ','-',$this->urlArray[0]);

            $pars = "SELECT * FROM `cards_shop` WHERE `id`=$pars";

            $sql = $this->sql->query($pars,'assoc');
            $this->pages = $sql;
            $thisSql = str2url(str_replace(' ','-',trim($sql["h3"]).' '.trim($sql["brend"]).' '.trim($sql["id"])));

            if ($pars_  == $thisSql){
                $sql['template'] = 'page';
                $this->pathTable = 'shop';
            }else{
                $sql['template'] = 'error';
            }
        }elseif (!$sql && empty($this->urlArray[0])){
            $sql['template'] = 'dashboard';
        }else{
            $sql["imgcountjson"] = json_decode($sql["img_count_json"],true);
            $sql["gallerryjson"] = json_decode($sql["gallerry_json"],true);
            $sql["gallerryjson2"] = json_decode($sql["img_count_json2"],true);
            $sql["jsons_template"] = json_decode($sql["jsons_template"],true);
        }

        return $sql;
    }
    public function mysql(){
        // Проверяем авторизацию - проверяем и admin и client cookie
        if ($_SESSION['admin'] || $_COOKIE['admin']){
            $sess = $_COOKIE['admin'] ?? $_SESSION['admin'];
            $user = $this->sql->query("SELECT * FROM `users` WHERE `sess` ='{$sess}'", 'assoc');
            if ($user){
                $this->admin = $user;
            }
        } elseif ($_SESSION['client'] || $_COOKIE['client']){
            $sess = $_COOKIE['client'] ?? $_SESSION['client'];
            $user = $this->sql->query("SELECT * FROM `users` WHERE `sess` ='{$sess}'", 'assoc');
            if ($user){
                $this->admin = $user;
            }
        }
        
        if (!$this->admin){
            $sql['template'] = 'authorization';
            return $sql;
        }
        
        // Удаляем 'admin' из urlArray если есть
        if (!empty($this->urlArray) && $this->urlArray[0] == 'admin'){
            array_shift($this->urlArray);
        }
        
        $sql = $this->getAdminSql();
        if (!$sql ){
            $sql['template'] = 'error';
        }

        return $sql;
    }
    public function sms($data){


        if(isset($_POST['return'])){
            $sms = $_POST['sms']?$data->sql->query("UPDATE `configadmin` SET `status`=1 WHERE id=1"):$data->sql->query("UPDATE `configadmin` SET `status`=0 WHERE id=1");
            $email = $_POST['email']?$data->sql->query("UPDATE `configadmin` SET `status`=1 WHERE id=2"):$data->sql->query("UPDATE `configadmin` SET `status`=0 WHERE id=2");
        }
        $sqli = "SELECT * FROM `configadmin` ";

        $sql['settings_admins'] = $data->sql->query($sqli);
        $sql['template'] = 'mainTown';
        return $sql;
    }
    public function sitemap($data){
         //echo date('r');
$res = [];
$res['url'] = $data->sql->query("SELECT `name` FROM `url` ");
$res['url']['gotovye-potolki'] = $data->sql->query("SELECT `name` FROM `gotovye-potolki` ");
$res['url']['town'] = $data->sql->query("SELECT `domen_city` as name FROM `town` ");
$res['url']['cards_shop'] = $data->sql->query("SELECT `id`,`h3`,`brend` FROM `cards_shop`  ");
$site = [];
foreach ($res['url']as $key=>$item){
if($key == 'town' || $key == 'gotovye-potolki'  ){
    foreach ($res['url']['town' ]as $k=>$i){
        if (!in_array($i['name'], $site) && !empty($i['name'])) {
            $site[] = $i['name'];
        }
    }
    foreach ($res['url']['gotovye-potolki' ]as $ke=>$ii){
        if ($ii['name'] != 'mains'){
            if (!in_array('gotovye-potolki/'.$ii['name'], $site) && !empty($ii['name'])) {
                $site[] = 'gotovye-potolki/'.$ii['name'];
            }
        }
    }
    foreach ($res['url']['cards_shop' ]as $kes=>$iis){

        if (!in_array(str2url($iis["h3"].' '.$iis["brend"].' '.$iis["id"]), $site) && !empty($item['name'])) {
            $site[] = str2url($iis["h3"].' '.$iis["brend"].' '.$iis["id"]);
        }



    }
}
    if ($item['name'] != 'mains'){
        if (!in_array($item['name'], $site) && !empty($item['name'])) {
            $site[] = $item['name'];
        }
    }
}
        $text = '<urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
';

foreach ($site as $value){
    $text .= "
<url>
<loc>".SITE.$value."</loc>
<lastmod>".date('c')."</lastmod>
<priority>1.00</priority>
</url>";
}
$text .= '</urlset>';
            $sql['template'] = 'mainTown';

        $filename = $_SERVER['DOCUMENT_ROOT'] . '/sitemap.txt';

        $fh = fopen($filename, 'w+');
        fwrite($fh, $text);
        fclose($fh);

        return $sql;
    }
    
    public function dashboard(){
        // Проверяем авторизацию - проверяем и admin и client cookie
        if ($_SESSION['admin'] || $_COOKIE['admin']){
            $sess = $_COOKIE['admin'] ?? $_SESSION['admin'];
            $user = $this->sql->query("SELECT * FROM `users` WHERE `sess` ='{$sess}'", 'assoc');
            if ($user){
                $this->admin = $user;
            }
        } elseif ($_SESSION['client'] || $_COOKIE['client']){
            $sess = $_COOKIE['client'] ?? $_SESSION['client'];
            $user = $this->sql->query("SELECT * FROM `users` WHERE `sess` ='{$sess}'", 'assoc');
            if ($user){
                $this->admin = $user;
            }
        }
        
        if (!$this->admin){
            $sql['template'] = 'authorization';
            return $sql;
        }
        
        $sql['template'] = 'dashboard';
        return $sql;
    }
    
    public function telegram(){
        // Проверяем авторизацию - проверяем и admin и client cookie
        if ($_SESSION['admin'] || $_COOKIE['admin']){
            $sess = $_COOKIE['admin'] ?? $_SESSION['admin'];
            $user = $this->sql->query("SELECT * FROM `users` WHERE `sess` ='{$sess}'", 'assoc');
            if ($user){
                $this->admin = $user;
            }
        } elseif ($_SESSION['client'] || $_COOKIE['client']){
            $sess = $_COOKIE['client'] ?? $_SESSION['client'];
            $user = $this->sql->query("SELECT * FROM `users` WHERE `sess` ='{$sess}'", 'assoc');
            if ($user){
                $this->admin = $user;
            }
        }
        
        if (!$this->admin){
            $sql['template'] = 'authorization';
            return $sql;
        }
        
        $sql['telegram_bot'] = $this->sql->query("SELECT * FROM `telegram_bot` LIMIT 1", 'assoc');
        $sql['template'] = 'telegram';
        return $sql;
    }
}