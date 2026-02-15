<?php

namespace classed;

class AdminController extends BaseController
{


    public function __construct(){

    }
    public function defaultPage(){

        $sql = $this->getAdminSql();
        if ($sql['template'] == 'authorization'){
           return $sql; // ИСПРАВЛЕНО: возвращаем массив, а не строку
        }else{
            // После getAdminSql() 'admin' уже удален из urlArray через array_shift()
            // Если urlArray пуст - показываем dashboard
            if (empty($this->urlArray)){
                $sql['template'] = 'dashboard';
                return $sql;
            }
            
            // Если есть второй элемент (например 'telegram') - вызываем соответствующий метод
            // Но после array_shift() это теперь urlArray[0]
            if (!empty($this->urlArray[0])){
                $method = $this->urlArray[0];
                if (method_exists($this, $method)){
                    return $this->$method();
                }
            }
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
            if (!$sql ){
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

            }else{

                $sql["imgcountjson"] = json_decode($sql["img_count_json"],true);
                $sql["gallerryjson"] = json_decode($sql["gallerry_json"],true);
                $sql["gallerryjson2"] = json_decode($sql["img_count_json2"],true);
                $sql["jsons_template"] = json_decode($sql["jsons_template"],true);
            }



        }
        return $sql;
    }
    
    public function telegram(){
        // Проверяем авторизацию
        $sql = $this->getAdminSql();
        if ($sql['template'] == 'authorization'){
            return $sql;
        }
        
        // Получаем настройки бота из БД
        $sql['telegram_bot'] = $this->sql->query("SELECT * FROM `telegram_bot` LIMIT 1", 'assoc');
        $sql['template'] = 'telegram';
        return $sql;
    }
    
    public function mysql(){

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
}