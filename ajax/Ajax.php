<?php
function send($host, $port, $login, $password, $phone, $text, $sender = false, $wapurl = false)
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

$sql = new \classed\Db();
if($_POST["soundClick"] == 'go'){
    sleep(5);
    echo 98985;




}
if($_POST['id_password']){
    sleep(2);
    $password = $_POST['password'];
    if ($password == 'admins'){

        $_SESSION['admin'] = md5(microtime(true));
        echo 1;
    }else{
        echo 0;
    }


    exit();
}







    if($_POST["sub"] == 'getform'){

        $work = [];
    $post = $_POST;

    $sql = "SELECT * FROM `types_of_work` WHERE id ={$post['id']}";

    $res = $this->sql->query($sql);

        foreach ($post['saveType'] as $value){
            if (strstr($value['name'],'id-')){

                if ('id-'.$post['id'] ==  $value['name']){
                    $msg = true;
                    echo $post['id'];


                }
                if ($value['value']){

                    $work[str_replace('id-','',$value['name'])] = $value['value'];
                }

            }
            if (strstr($value['name'],'price-')){
                if (array_key_exists(str_replace('price-','',$value['name']), $work)) {
                    $work[str_replace('price-','',$value['name'])] = [$work[str_replace('price-','',$value['name'])],$value['value']] ;
                }
            }



        }
        if ($work){
            $work = json_encode($work);
            $sql = "UPDATE `price_smeta` SET `types_of_work` = '$work' WHERE `price_smeta`.`id_client` ='{$post['client_id']}' AND `price_smeta`.`id` ='{$post['id_rooms']}'";
        }


$this->sql->query($sql);
        if ($post['update'] == 0){
            $str = '<div class="flexrows border">
                    ';
            foreach ($res as $key=>$value){
                $str .='<p>'.$value["name"].':</p>
                  
                    <div><input class="smeta_row update" type="number" name="id-'.$value["id"].'" value=""></div>
                    <div><input class="smeta_row update" type="number" name="price-'.$value["id"].'" value="'.$value["price"].'"></div>
                </div>';
            }
            if (!$msg){
                echo $str;
                exit();
            }
        }

exit();
}

if($_POST["sub"] == 'saveType'){
    $post = $_POST['data'];
    $id = $_POST['id'];
    //echo debug($post);
    $work = [];
    foreach ($post as $key=>$value){

        if (strstr($value['name'],'id-')){
            $work[str_replace('id-','',$value["name"])] =  $value["value"];

        }
        if (strstr($value['name'],'id-')){
            $work[str_replace('price-','',$value["name"])] =  $value["value"];

        }

        if($value["name"]=='manufacture'){
            $manufacture = $value['value'];
        }
        if($value["name"]=='material'){
            $material = $value['value'];
        }

    }
    echo debug($work);
    $workJson = json_encode($work);

    $sql = "UPDATE `price_smeta` SET `types_of_work` = '$workJson',`id_manufacture` = $manufacture, `id_material` = $material WHERE `price_smeta`.`id` =". (int)$id;


    //echo debug($sql);
    $sql = $this->sql->query($sql);



exit();

}


if($_POST["sub"] == 'clientform'){

    $res = json_decode($_POST['name']);

    $img = $res->images;
    $room = $res->room;
    $area = $res->area;
    $perimeter = $res->perimeter;
    $curvilinear = $res->curvilinear;
    $angles = $res->angles;
    $manufacture = $res->manufacture;
    $material = $res->material;
    $client_id = $res->client_id;
    $sides = json_encode($res->linesLength->lines,JSON_UNESCAPED_UNICODE);
    $diags = json_encode($res->linesLength->diags,JSON_UNESCAPED_UNICODE);


    $sql = "INSERT INTO `price_smeta`(`id_client`, `id_room`, `id_manufacture`, `id_material`, `area`, `perimeter`, `curvilinear`, `angles`, `img`, `sides`, `diags`) 
        VALUES ($client_id,$room,$manufacture,$material,$area,$perimeter,$curvilinear,$angles,'$img','$sides','$diags')";
    $this->sql->query($sql);
    $sql = "SELECT * FROM `price_smeta` WHERE `id_room` = $room AND `id_client` = $client_id";
    $id = $this->sql->query($sql);
    echo $id[0]['id'];
    exit();
}

if($_POST["sub"] == 'updateroom'){


    $sql = "UPDATE `price_smeta` SET `id_room`=".$_POST["id_"]." WHERE `id_client`='".$_POST["client_id"]."'";
    $this->sql->query($sql);
    echo true;
    exit();
}

if($_POST["sub"] == 'getAjax') {

    $login = "z1447758852983";
    $password = "537489";
    $phonemy = '89996371182';
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
        
        // Получаем настройки из БД
        $settingsQuery = "SELECT * FROM `settings` WHERE `name` = 'configadmin' LIMIT 1";
        $settingsResult = $sql->query($settingsQuery, 'assoc');
        $settings = array();
        if ($settingsResult && isset($settingsResult['value'])) {
            $settings = json_decode($settingsResult['value'], true);
        }
        
        $mail = false;
        if (isset($settings[1]['status']) && $settings[1]['status'] == 1){
            $mail = mail($to, $subject, $message, $header);
        }

        switch ($type) {
            case 'call':
                $phone .= " CallBack ".$name;
                break;
            case 'low':
                $phone .= " По самой низкой цене ";
                break;

        }
        if (!empty($phone)) {
            if (isset($settings[2]['status']) && $settings[2]['status'] == 1){//разрешено все
                $sms = send("gate.iqsms.ru", 80, $login, $password, $phonemy, $phone, "Proffi", "wap.yousite.ru");
            }else{
                if (isset($settings[0]['status']) && $settings[0]['status'] == 1 && $type == 'CallBack'){
                    $sms = send("gate.iqsms.ru", 80, $login, $password, $phonemy, $phone, "Proffi", "wap.yousite.ru");
                }
            }
        }
        
        // Отправка в Telegram (НЕЗАВИСИМО от успешности отправки email)
        try {
            $notifierPath = dirname(__FILE__) . '/../includes/TelegramNotifier.php';
            if (file_exists($notifierPath)) {
                require_once $notifierPath;
                $notifier = new TelegramNotifier();
                
                // Формируем данные заявки
                $lead = array(
                    'name' => $name,
                    'phone' => $phone,
                    'email' => !empty($email) ? $email : '',
                    'message' => !empty($txt) ? $txt : '',
                    'service' => $type == 'item_send' ? 'Заказ товара ' . $art : $type,
                    'region' => !empty($town) ? $town : ''
                );
                
                // Метаданные
                $meta = array(
                    'host' => $_SERVER['HTTP_HOST'],
                    'url' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
                    'referer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
                    'datetime' => date('Y-m-d H:i:s')
                );
                
                // UTM метки из GET или POST
                if (isset($_GET['utm_source'])) $meta['utm_source'] = $_GET['utm_source'];
                if (isset($_GET['utm_medium'])) $meta['utm_medium'] = $_GET['utm_medium'];
                if (isset($_GET['utm_campaign'])) $meta['utm_campaign'] = $_GET['utm_campaign'];
                
                $notifier->sendLead($lead, $meta);
            }
        } catch (Exception $e) {
            // Ошибка Telegram не должна ломать форму
            error_log('Telegram notification error: ' . $e->getMessage());
        }
        
        echo TRUE;
        exit();
    }
}



exit();

