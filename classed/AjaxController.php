<?php


namespace classed;


class AjaxController extends BaseController
{
    protected $sql;
    protected $mail = "dsc-23@yandex.ru";
    protected $login = "z1447758852983";
    protected $password = "537489";
    protected $myPhone = '89996371182';
    protected $settings ;
    public function __construct()
    {
        $this->sql = new Db();
        $method = $_POST['success'];
        if (method_exists($this,$method)){
            $this->$method();
        }else{
            $this->getAjax();
        }

        exit();

    }
    static public function get($property){
        return self::instance()->$property;
    }
    protected function newroom(){

        $text = $_POST['room'];
        $this->sql->query("INSERT INTO `room`(`name`) VALUES ('$text')");

    }
    protected function addSmeta(){
        $ceilingId = $_POST['ceilingId'];
        $data = $_POST['data'];
        $data = json_encode($data);
        $this->sql->query("UPDATE `smeta` SET `smeta` = '$data' WHERE `smeta`.`id` = $ceilingId");

        exit();
    }
    protected function editPrice(){
        $ceilingId = $_POST['ceilingId'];
        $editType = $_POST['editType'];
        $res = $_POST['res'];
        $result = json_decode($this->sql->query("SELECT `editprice` FROM `smeta` WHERE `id` = $ceilingId",'assoc')['editprice'],true);
        $result[$editType] = $res;

        $resultJson = json_encode($result);

        $this->sql->query("UPDATE `smeta` SET `editprice` = '$resultJson' WHERE `smeta`.`id` = $ceilingId;");
    echo $resultJson;
        exit();
    }
    protected function currentDrawing(){
        $client = $_POST['client'];

        if ($client['newClient']){
            $id_client = $this->sql->query("INSERT INTO `client`(`user_id`, `name`, `phone`) VALUES ({$client['user_id']},'{$client['name']}','{$client['phone']}')",'id');
        }
        if ($id_client){
            $client['client_id'] = $id_client;
        }
        if ($client['newAdress']){

            $id_adress = $this->sql->query("INSERT INTO `client_adress`(`user_id`, `client_id`, `adress`) VALUES ({$client['user_id']},{$client['client_id']},'{$client['adress']}')",'id');
        }else{
            $id_adress = $this->sql->query("SELECT * FROM `client_adress` WHERE `adress` ='{$client['adress']}' AND `client_id` = {$client['client_id']}",'assoc')['id'];
        }
        if ($id_adress){
            $client['adress'] = $id_adress;
        }
        if ($client['newCeiling']){

            $days = $this->days();
            $lines_length  = json_encode($client['lines_length']);
            $koordinats_poloten  = json_encode($client['koordinats_poloten']);
            $smeta = json_encode($client['smeta']);
            $id_smeta = $this->sql->query("INSERT INTO `smeta`(`adress_id`,`id_user`, `client_id`, `room_id`, `days`, `lines_length`,   `koordinats_poloten`, `room_area`,                    `perimeter`,           `angles_count`, `perimeter_shrink`,                     `curvilinear_length`,          `inner_cutout_length`,        `texture_id`,          `color_id`,        `manufacturer_id`,              `width_final`,             `square_obrezkov`,             `drawing_data`, `smeta`) 
                                             VALUES ('{$client['adress']}',{$client['user_id']},{$client['client_id']},{$client['room_id']},'$days','$lines_length','$koordinats_poloten',{$client['room_area']},{$client['perimeter']},{$client['angles_count']},{$client['perimeter_shrink']},{$client['curvilinear_length']},{$client['inner_cutout_length']},{$client['texture_id']},{$client['color']},{$client['manufacturer_id']},{$client['width_final']},{$client['square_obrezkov']},'{$client['drawing_data']}','$smeta')",'id');
        }
        $sql = [];
        $sql['client'] = ($this->getSqlClient($client['user_id']));
        $sql['clientAdress'] = ($this->sql->query("SELECT * FROM `client_adress`"));
        $getClient = $this->getClient($client['client_id'],$client['adress'],$client['user_id'],'get');
        echo json_encode(['client'=>$sql['client'],'clientAdress'=>$sql['clientAdress'],'getClient'=>$getClient]);
        exit();
    }
    public function setClient(){
        $client = $_POST['clientId'];
        $adress_id = $_POST['clientAdressId'];
        $user_id = $_POST['user_id'];
        $sql = $this->sql->query("SELECT `smeta`.*,`base`.`texture`,`base`.`manufacturer`,`base`.`price`,`base`.`price_montage`,`base`.`width`,`base`.`name` as 'material',`base`.`color`,`base`.`hex`,`client_adress`.`adress`,`client`.`name`,`client`.`phone`
FROM `smeta`
LEFT JOIN `client` ON `client`.`id` = `smeta`.`client_id`
LEFT JOIN `client_adress` ON `client_adress`.`id` = `smeta`.`adress_id`
LEFT JOIN `base` ON `smeta`.`texture_id` = `base`.`texture_id` AND `smeta`.`manufacturer_id` = `base`.`manufacturer_id` AND `smeta`.`color_id` = `base`.`color` AND `smeta`.`width_final` = `base`.`width`
WHERE `smeta`.`id_user` = $user_id AND `smeta`.`client_id` = $client AND `smeta`.`adress_id` = $adress_id");


        foreach ($sql as $key=>$item){
            $sql[$key]['editprice'] = json_decode($item['editprice']);
            $sql[$key]['lines_length'] = json_decode($item['lines_length']);
            $sql[$key]['koordinats_poloten'] = json_decode($item['koordinats_poloten']);
//            $sql[$key]['drawing_data'] = json_decode($item['drawing_data']);
            $sql[$key]['smeta'] = json_decode($item['smeta']);
        }
        echo json_encode($sql);
    }
    protected function formclient(){
        $post = $_POST;
        $from = $_SERVER['HTTP_HOST']."<info@{$_SERVER['SERVER_NAME']}>";

        $subject = "Заявка";

        $message = "<p>Клиент одобрил смету</p>";
        $message .= "<p>Имя : ".$post['client']."</p>";
        $tel = trim($post['phone']);
        $message .= "<p><a href='tel:".$tel."'>".$post['phone']."</a></p>";
        $header = "From: $from\nReply-To: $from\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

           mail($this->mail, $subject, $message, $header);



            $sms = $this->send("gate.iqsms.ru", 80, $this->login, $this->password, $this->myPhone, $post['phone'].' !', "Proffi", "wap.yousite.ru");
echo json_encode(['return'=>'В ближайшее время с вами свяжеться менеджер для назначении даты монтажа']);
        exit();
    }
    protected function fopenFilesSmeta($filename,$text ){

        $text .= file_get_contents("template/calc/smetaClientov/template/files.php");
        $f_hdl = fopen($filename, 'w+');

            $res  = fwrite($f_hdl, $text);


        fclose($f_hdl);
        if (file_exists($filename)){
            return true;
        }else{
            return false;
        }
    }
    protected function fopenFilesSmetaPRO($filename,$text ){


        $f_hdl = fopen($filename, 'w+');

        $res  = fwrite($f_hdl, $text);


        fclose($f_hdl);
        if (file_exists($filename)){
            return true;
        }else{
            return false;
        }
    }
    protected function htmlspecificationSmeta(){
        $return = [];
        $post = $_POST;
        $filename = 'template/calc/smetaPro/'.$post['number_order'].'.php';
        $text = $post['contentHTML'];


        if ($this->fopenFilesSmetaPRO($filename,$text)){

            $return['url'] = "http://".$_SERVER['HTTP_HOST']."/calc/pro/".$post['number_order'];
            echo json_encode($return);
        }else{
            echo 'Ошибка';
        }


        exit();
    }
    protected function formSmetaHTML(){
        $return = [];
        $post = $_POST;
        $filename = 'template/calc/smetaClientov/'.$post['number_order'].'.php';
        $text = $post['contentHTML'];


        if ($this->fopenFilesSmeta($filename,$text)){
            $return['url'] = "http://".$_SERVER['HTTP_HOST']."/calc/".$post['number_order'];
            echo json_encode($return);
        }


        exit();
    }
    public function getClient($client = false, $adress_id = false, $user_id = false,$flag = false){
        if(!$client && !$adress_id && !$user_id){
            $client = $_POST['obj']['id'];
            $adress_id = $_POST['adress_id'];
            $user_id = $_POST['obj']['user_id'];
        }

        $sql = $this->sql->query("SELECT `smeta`.`editprice`,`smeta`.`id`, `smeta`.`id_user`, `smeta`.`client_id`, `smeta`.`adress_id`, `smeta`.`room_id`, `smeta`.`days`, `smeta`.`lines_length`, `smeta`.`koordinats_poloten`, `smeta`.`room_area`, `smeta`.`perimeter`, `smeta`.`angles_count`, `smeta`.`perimeter_shrink`, `smeta`.`curvilinear_length`, `smeta`.`inner_cutout_length`, `smeta`.`texture_id`, `smeta`.`color_id`, `smeta`.`manufacturer_id`, `smeta`.`width_final`, `smeta`.`square_obrezkov`, `smeta`.`drawing_data`,`smeta`.`smeta`,`base`.`texture`,`base`.`manufacturer`,`base`.`price`,`base`.`price_montage`,`base`.`width`,`base`.`name` as 'material',`base`.`color`,`base`.`hex`,`client_adress`.`adress`,`client`.`name`,`client`.`phone`
FROM `smeta`
LEFT JOIN `client` ON `client`.`id` = `smeta`.`client_id`
LEFT JOIN `client_adress` ON `client_adress`.`id` = `smeta`.`adress_id`
LEFT JOIN `base` ON `smeta`.`texture_id` = `base`.`texture_id` AND `smeta`.`manufacturer_id` = `base`.`manufacturer_id` AND `smeta`.`color_id` = `base`.`color` AND `smeta`.`width_final` = `base`.`width`
WHERE `smeta`.`id_user` = $user_id AND `smeta`.`client_id` = $client AND `smeta`.`adress_id` = $adress_id AND `smeta`.`delete_ceiling` = 'false'");
        if($flag == 'get'){
            return $sql;
        }else{
            echo json_encode($sql);
        }

    }
    protected function getNewClient($item){
        $client = $this->sql->query("SELECT * FROM `client` WHERE `user_id` = {$item['id_user']}  AND `name`= '{$item['name']}' AND `phone`= '{$item['phone']}' ",'assoc')['id'];
        if($client)return $client;
        return   $this->sql->query("INSERT INTO `client`(`user_id`, `name`, `phone`) VALUES ({$item['id_user']},'{$item['name']}','{$item['phone']}')",'id');


    }
    protected function getNewClientAdress($item,$client){
        $adress_id = $this->sql->query("SELECT * FROM `client_adress` WHERE `user_id` = {$item['id_user']} AND `client_id` = $client AND `adress` ='{$item['adress']}'",'assoc')['id'];

        if($adress_id)return $adress_id;
        return  $this->sql->query("INSERT INTO `client_adress`(`user_id`, `client_id`, `adress`) VALUES ({$item['id_user']},$client,'{$item['adress']}')",'id');

    }
    protected function getnewCeiling($value,$client,$adress_id){
        if (!$client)$client = $value['client_id'];
        if (!$adress_id)$adress_id = $this->sql->query("SELECT * FROM `client_adress` WHERE `adress` = '{$value['adress']}' AND `client_id` = {$client}",'assoc')['id'];

        $value['lines_length'] = json_encode($value['lines_length']);
        $value['koordinats_poloten'] = json_encode($value['koordinats_poloten']);
        $value['smeta'] = json_encode($value['smeta']);
        $value['editprice'] = json_encode($value['editprice']);
         if ($this->sql->query("INSERT INTO `smeta`(`id_user`           ,`client_id`         , `adress_id`, `room_id`          , `days`           , `lines_length`           , `koordinats_poloten`           , `room_area`         , `perimeter`         , `angles_count`         , `perimeter_shrink`        , `curvilinear_length`          , `inner_cutout_length`         , `texture_id`         , `color_id`        , `manufacturer_id`          , `width_final`         , `square_obrezkov`         , `drawing_data`           , `smeta`           , `editprice`) 
                                              VALUES ({$value['id_user']},$client,$adress_id,{$value['room_id']},'{$value['days']}','{$value['lines_length']}','{$value['koordinats_poloten']}',{$value['room_area']},{$value['perimeter']},{$value['angles_count']},{$value['perimeter_shrink']},{$value['curvilinear_length']},{$value['inner_cutout_length']},{$value['texture_id']},{$value['color_id']},{$value['manufacturer_id']},{$value['width_final']},{$value['square_obrezkov']},'{$value['drawing_data']}','{$value['smeta']}','{$value['editprice']}')",'id')){
          return true;
        }
    }
    protected function getDeleteCeiling($item){
        if ($this->sql->query("SELECT * FROM `smeta` WHERE `id` = {$item['id']} AND `id_user` = {$item['id_user']} AND `client_id` = {$item['client_id']} ")){
            $res = $this->sql->query("UPDATE `smeta` SET `delete_ceiling` = 'true' WHERE `id` = {$item['id']} AND `id_user` = {$item['id_user']} AND `client_id` = {$item['client_id']}");
        }else{
            return false;
        }

    }
    protected function getUpdateRoom($item){
        $res = $this->sql->query("UPDATE `smeta` SET `room_id` = {$item['room_id']} WHERE `id` = {$item['id']}");

    }
    protected function getUpdateAll($item){
        $smetaJson = json_encode($item['smeta'],JSON_UNESCAPED_UNICODE);
        $res = $this->sql->query("UPDATE `smeta` SET `smeta` = '$smetaJson' WHERE `smeta`.`id` = {$item['id']}");

    }
    protected function getFormData(){
        $post = $_POST;

        $success = [];
        $file = $_FILES['file'];
        $path =  'template/calc/images/material/';
        $post['types_of_work'] = json_decode($post['types_of_work'],JSON_UNESCAPED_UNICODE);
        foreach ($post['types_of_work'] as $value){
            if ($value['name'] == $post['name']){
                $success['error'] = "Такое наименование уже имеется";
                echo json_encode($success);exit();
            }

        }
        if (isset($_FILES['file'])) {
            $deny = array(
                'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp',
                'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html',
                'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
            );
            $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
            $name = mb_eregi_replace($pattern, '-', $file['name']);
            $name = mb_ereg_replace('[-]+', '-', $name);
            $parts = pathinfo($name);
            if (empty($name) || empty($parts['extension'])) {
                $success['error'] = 'Недопустимый тип файла';
            } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                $success['error'] = 'Недопустимый тип файла';
            } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
                $success['error'] = 'Недопустимый тип файла';
            } else {
                $name = BaseController::translit_file($name);
                if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                    $success['file'] = 'Файл успешно сохранен';
                } else {
                    $success['file'] = 'Не удалось загрузить файл.';
                }
            }
        }
if (!$name)$name = '';
if (!$post['multiple'])$post['multiple'] = 1;

       $id = $this->sql->query("INSERT INTO `types_of_work`(`group_id`        ,`kinds`        , `name`          , `id_unit_of_measurement`, `multiple`        , `price`              , `price_diler`         , `price_montaj`   , `photo`, `communications_id`) 
                                                      VALUES ({$post['groops']},{$post['kinds']},'{$post['name']}',{$post['unit']}          ,{$post['multiple']},{$post['priceClient']},{$post['material']},{$post['priceMontaj']},'$name',{$post['communications']})",'id');
        if ($id !=0){
            $success['error'] = "Запись успешно создана";
            $types_of_work = $sql['types_of_work'] = $this->sql->query("SELECT `types_of_work`.* ,`groups`.`name` as 'namegroops' FROM `types_of_work` LEFT JOIN `groups` ON `types_of_work`.`group_id` = `groups`.`id`");
        }
        $success['types_of_work'] = $types_of_work;
        echo json_encode($success);
        exit();
    }
    protected function nameGroops(){
        $msg = [];
        $post = $_POST;

        $post['nameGroops'] = mb_ucfirst($post['nameGroops']);
        $res = $this->sql->query("INSERT INTO `groups`(`name`) VALUES ('{$post['nameGroops']}')");
        if ($res){
            $msg['noty'] = 'Успешное создание категории';
        }else{
            $msg['noty'] = 'Ошибка записи';
        }

         $msg['groups'] = $this->sql->query("SELECT * FROM `groups`");

         echo json_encode($msg);
        exit();
    }
    protected function updateCeiling($post){
        $post['lines_length'] = json_encode($post['lines_length'],JSON_UNESCAPED_UNICODE);
        $post['koordinats_poloten'] = json_encode($post['koordinats_poloten'],JSON_UNESCAPED_UNICODE);
        $post['smeta'] = json_encode($post['smeta'],JSON_UNESCAPED_UNICODE);
        $post['editprice'] = json_encode($post['editprice'],JSON_UNESCAPED_UNICODE);
        $res = $this->sql->query("UPDATE `smeta` SET
                 
                 `id_user`= {$post['id_user']},
                 `client_id`= {$post['client_id']},
                 `adress_id`= {$post['adress_id']},
                 `room_id`= {$post['room_id']},
                 `days`= '{$post["days"]}',
                 `lines_length`= '{$post["lines_length"]}',
                 `koordinats_poloten`= '{$post["koordinats_poloten"]}',
                 `room_area`= {$post['room_area']},
                 `perimeter`= {$post['perimeter']},
                 `angles_count`= {$post['angles_count']},
                 `perimeter_shrink`= {$post['perimeter_shrink']},
                 `curvilinear_length`= {$post['curvilinear_length']},
                 `inner_cutout_length`= {$post['inner_cutout_length']},
                 `texture_id`= {$post['texture_id']},
                 `color_id`= {$post['color_id']},
                 `manufacturer_id`= {$post['manufacturer_id']},
                 `width_final`= {$post['width_final']},
                 `square_obrezkov`= {$post['square_obrezkov']},
                 `drawing_data`= '{$post["drawing_data"]}',
                 `smeta`= '{$post["smeta"]}',
                 `editprice`= '{$post["editprice"]}',
                 `delete_ceiling`= '{$post["updateCeiling"]}' WHERE  `id` = {$post['id']}");


    }
    protected function getStorage(){
        $msg = [];
        $post = json_decode($_POST['storage'],JSON_UNESCAPED_UNICODE);
       foreach ($post as $key=>$value){
          if ($value['updateCeiling'] == true){
              $this->updateCeiling($value);
          }
          if ($value['updateSmeta'] == true){
              $this->getUpdateAll($value);
          }
          if ($value['update_room'] == true){
              $this->getUpdateRoom($value);
          }
          if ($value['delete_ceiling'] == 'true'){

                   $msg['getDeleteCeiling'] = $this->getDeleteCeiling($value);

          }
          if ($value['newClient']){
              $client =  $this->getNewClient($value);
          }
          if ($value['newAdress']){
              $adress_id = $this->getNewClientAdress($value,$client);
          }
           if ($value['newCeiling']){
               if ($this->getnewCeiling($value,$client,$adress_id)){
                   $msg = true;
               }
           }


       }
        if ($_COOKIE['client']) $this->client = BaseController::getClient();
        $sql['cl'] = $this->getSqlClient($this->client);
        $sql['adress'] = $this->sql->query("SELECT * FROM `client_adress`");


           echo json_encode($sql);

        exit();


    }
    protected function getAjax()
    {

        $name = $_POST['name'];
        $phone = $_POST['tel'];
        $town = $_POST['town'];
        $type = $_POST['type'];

        $email = $_POST['email'];
        $txt = $_POST['txt'];
        $art = $_POST['art'];
        $id = $_POST['id'];


        $name = strip_tags(addslashes($name));
        $phone = strip_tags(addslashes($phone));




        if (empty($name) || empty($phone)) {
            echo false;
        } else {

            $from = "proffi-center<info@{$_SERVER['SERVER_NAME']}>";
            $to = "dsc-23@yandex.ru";
            if ($type == 'item_send'){
                $subject = "Заказ товара  ".$art;
                $message = "<center><h3>Заказ товара</h3></center>";

                $message .= "<p>Имя : ".$name."</p>";
                $message .= "<p><a href='tel:".$phone."'>".$phone."</a></p>";
                $message .= "<p>".$email."</p>";
                $message .= "<p>".$txt."</p>";
            }else{
                $subject = "Срочное ";
                $message = "<center><h3>".$type."</h3></center>";
                $message .= "<p>Город : " . $town . "</p>";
                $message .= "<p>Имя : " . $name . "</p>";
                $message .= "<p><a href='tel:" . $phone . "'>" . $phone . "</a></p>";
            }

            $header = "From: $from\nReply-To: $from\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            $this->settings = Settings::get('settings');
            if ($this->settings['config']['email'] === true){
                $mail = mail($to, $subject, $message, $header);
            }


            switch ($type) {
                case 'call':
                    $text = $phone . " CallBack ".$name;
                    break;
                case 'low':
                    $text = $phone . " По самой низкой цене ";
                    break;
                default:
                    $text = $phone . " По default ";
                    break;

            }


                if ($this->settings['config']['sms'] === true && !empty($phone)){

                    $sms = $this->send("gate.iqsms.ru", 80, $this->login, $this->password, $this->myPhone, $text, "Proffi", "wap.yousite.ru");
                }

            if ($mail) {

                echo TRUE;
            }

        }
    }
    protected function send($host, $port, $login, $password, $phone, $text, $sender = false, $wapurl = false)
    {
        $fp = fsockopen($host, $port, $errno, $errstr);
        if (!$fp) {
            return "errno: $errno \nerrstr: $errstr\n";
        }
        fwrite($fp, "GET /send/" .
            "?phone=" . rawurlencode($phone) .
            "&text=" . rawurlencode($text) .
            ($sender ? "&sender=" . rawurlencode($sender) : "") .
            ($wapurl ? "&wapurl=" . rawurlencode($wapurl) : "") .
            "  HTTP/1.0\n");
        fwrite($fp, "Host: " . $host . "\r\n");
        if ($login != "") {
            fwrite($fp, "Authorization: Basic " .
                base64_encode($login . ":" . $password) . "\n");
        }
        fwrite($fp, "\n");
        $response = "";
        while (!feof($fp)) {
            $response .= fread($fp, 1);
        }
        fclose($fp);
        list($other, $responseBody) = explode("\r\n\r\n", $response, 2);
        return $responseBody;
    }
    protected function newclient(){
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $adress = $_POST["adress"];
        $cach = md5($name.$phone.$adress);
        $sql = "INSERT INTO `client`( `name`, `adress`, `phone`, `cach`) VALUES ('$name','$adress','$phone','$cach')";
        $res = $this->sql->query($sql);

        $sql = $this->sql->query("SELECT id FROM `client` WHERE `cach` = '$cach'");
        echo $sql[0]["id"];
    }
    protected function get_edit_content(){
        $post = $_POST;

        $post['selector'] = explode(':',$post['selector']);
        $query = $this->sql->query("SELECT * FROM `{$post['pathTable']}` WHERE `template` = '{$post['template']}'",'assoc');

        $sql = json_decode($query[$post['selector'][0]],true);
       if($post['typeid'] == 'num'){

           $sql[$post['selector'][1]] = $post['data'];
            $sql = json_encode($sql);
            if($this->sql->query("UPDATE `{$post['pathTable']}` SET `{$post['selector'][0]}` = '$sql' WHERE `id` = {$query['id']};")){
                echo 1;
            }else{
                echo "UPDATE `{$post['pathTable']}` SET `{$post['selector'][0]}` = '$sql' WHERE `id` = {$query['id']};";
            }
        }
        if($post['typeid'] == 'img'){


            $post['img'] = str_replace("url(\"",'',$post['img']);
            $path = $_SERVER["DOCUMENT_ROOT"] .strstr($post['img'], 'images/', true).'images/';
            $sql[$post['selector'][1]] = strstr($post['img'], 'images/', true).'images/'.$_FILES['file']['name'];
            if (move_uploaded_file($_FILES['file']['tmp_name'], $path . $_FILES['file']['name'])) {
                // Далее можно сохранить название файла в БД и т.п.

                $img =  $sql['bg_baner'];
            } else {
                $error = 'Не удалось загрузить файл.';
            }
            $sql = json_encode($sql);

            if($this->sql->query("UPDATE `{$post['pathTable']}` SET `{$post['selector'][0]}` = '$sql' WHERE `id` = {$query['id']};")){
                echo json_decode($img);
            }else{
                echo "UPDATE `{$post['pathTable']}` SET `{$post['selector'][0]}` = '$sql' WHERE `id` = {$query['id']};";
            }

        }

        exit();
    }

    protected function getstreet(){
        $up = $_POST["up"];
        $street  = "SELECT * FROM `street` WHERE `name` LIKE '%$up%' LIMIT 5";
        $street = $this->sql->query($street);
        if ($street){
            $str = '';
            foreach ($street as $item) {

                $str .= "<p data-purpose='".$item['purpose']."'>".$item['name']."</p>";
            }
            echo $str;
        }
    }

    protected function autz_admin(){
        $login = $_POST['name'];
        $password = $_POST['password'];
        $login = strip_tags(addslashes($login));
        
        $password = md5(strip_tags(addslashes($password)));
        if (empty($login) && empty($password)){
            echo false;
        }else{
            $sql = "SELECT * FROM `users` WHERE `login` = '".$login."' AND `password` = '".$password."'";
            $res = $this->sql->query($sql ,'assoc');
            if (!$res) echo false;
            $sess = $sess = md5(microtime());
            $this->sql->query("UPDATE `users` SET `sess` = '".$sess."' WHERE `login` = '".$login."' AND `password` = '".$password."'");
            
            if ($res){
                setcookie("admin", $sess, time()+3600*24);  /* срок действия 24 час */
                $_SESSION['admin'] = $sess;
                echo true;
            }
        }
    }

    protected function autz_client(){
        $login = $_POST['name'];
        $password = $_POST['password'];
        $login = strip_tags(addslashes($login));

        $password = md5(strip_tags(addslashes($password)));
        if (empty($login) && empty($password)){
            echo false;
        }else{
            $sql = "SELECT * FROM `users` WHERE `login` = '".$login."' AND `password` = '".$password."'";
            $res = $this->sql->query($sql ,'assoc');
            if (!$res) echo false;
            $sess = $sess = md5(microtime());
            $this->sql->query("UPDATE `users` SET `sess` = '".$sess."' WHERE `login` = '".$login."' AND `password` = '".$password."'");

            if ($res){
                setcookie("client", $sess, time()+3600*24);  /* срок действия 24 час */
                $_SESSION['client'] = $sess;
                echo true;
            }
        }
    }
    
    protected function saveTelegramBot(){
        $botToken = $_POST['bot_token'] ?? '';
        $botUsername = $_POST['bot_username'] ?? '';
        $autoWebhook = isset($_POST['auto_webhook']) && $_POST['auto_webhook'] == 'true';
        
        $response = ['success' => false, 'message' => ''];
        
        if (empty($botToken)) {
            $response['message'] = 'Токен бота не может быть пустым.';
            echo json_encode($response);
            return;
        }
        
        $botToken = $this->sql->sql->real_escape_string($botToken);
        $botUsername = $this->sql->sql->real_escape_string($botUsername);
        $webhookUrl = SITE . '/admin/telegram/webhook';
        
        $existingSettings = $this->sql->query("SELECT * FROM `telegram_bot` LIMIT 1", 'assoc');
        
        if ($existingSettings) {
            $this->sql->query("UPDATE `telegram_bot` SET `bot_token` = '$botToken', `bot_username` = '$botUsername', `webhook_url` = '$webhookUrl' WHERE `id` = {$existingSettings['id']}");
        } else {
            $this->sql->query("INSERT INTO `telegram_bot` (`bot_token`, `bot_username`, `webhook_url`) VALUES ('$botToken', '$botUsername', '$webhookUrl')");
        }
        
        if ($autoWebhook) {
            $setWebhookResult = $this->setTelegramWebhook($botToken, $webhookUrl);
            if ($setWebhookResult['ok']) {
                $response['success'] = true;
                $response['message'] = 'Настройки бота сохранены и webhook успешно установлен.';
            } else {
                $response['message'] = 'Настройки бота сохранены, но не удалось установить webhook: ' . ($setWebhookResult['description'] ?? 'Неизвестная ошибка');
            }
        } else {
            $response['success'] = true;
            $response['message'] = 'Настройки бота сохранены.';
        }
        
        echo json_encode($response);
    }
    
    protected function testTelegramBot(){
        $response = ['success' => false, 'message' => ''];
        $settings = $this->sql->query("SELECT * FROM `telegram_bot` LIMIT 1", 'assoc');
        
        if (!$settings || empty($settings['bot_token'])) {
            $response['message'] = 'Токен бота не настроен.';
            echo json_encode($response);
            return;
        }
        
        $botToken = $settings['bot_token'];
        $apiUrl = "https://api.telegram.org/bot{$botToken}/getMe";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode == 200 && $result) {
            $data = json_decode($result, true);
            if ($data['ok']) {
                $response['success'] = true;
                $response['message'] = 'Бот успешно подключен!';
                $response['bot_info'] = $data['result'];
            } else {
                $response['message'] = 'Ошибка Telegram API: ' . ($data['description'] ?? 'Неизвестная ошибка');
            }
        } else {
            $response['message'] = 'Не удалось подключиться к Telegram API. Код ошибки: ' . $httpCode;
        }
        
        echo json_encode($response);
    }
    
    protected function setTelegramWebhook($botToken, $webhookUrl){
        $apiUrl = "https://api.telegram.org/bot{$botToken}/setWebhook?url=" . urlencode($webhookUrl);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

}