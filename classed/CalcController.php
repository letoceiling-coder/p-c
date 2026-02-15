<?php


namespace classed;


class CalcController extends BaseController
{

    public function __construct(){

    }
    public function defaultPage(){
          
        $this->days = $this->days();
        $gets = "";
        $sql['base'] = json_encode($this->sql->query("SELECT * FROM `base`"));
        $sql['rooms'] = json_encode($this->sql->query("SELECT * FROM `room`"));

        $sql['clientAdress'] = $this->sql->query("SELECT * FROM `client_adress` $gets");
        if ($_COOKIE['client']) $this->client = $this->getClient();
        if ($this->client && !$this->urlArray[1]){
            $sql['client'] = $this->getSqlClient($this->client);
            $sql['client'] = json_encode($sql['client'],JSON_UNESCAPED_UNICODE);
            $sql['user'] = json_encode($this->sql->query("SELECT * FROM `settingcompany` WHERE `id_user` =  {$this->client}",'assoc'),JSON_UNESCAPED_UNICODE);

            if ($sql){
                if (!$sql['template']){
                    $sql['template'] = 'page';
                    $sql['setClient'] = 'null';

                }
            }else{

                $sql['template'] = 'error';
            }

        }else{
            if ($this->urlArray[1]){

                if ($this->urlArray[1] == 'pro'){
                    $explode = explode('-',$this->urlArray[2]);
                    $sql['client'] = $this->getSqlClient($explode[0],$explode[1]);

                    $sql['setClient'] = (AjaxController::getClient($explode[1], $explode[2], $explode[0],'get'));



                }else{
                    $explode = explode('-',$this->urlArray[1]);
                    $sql['client'] = $this->getSqlClient($explode[0],$explode[1]);

                    $sql['setClient'] = (AjaxController::getClient($explode[1], $explode[2], $explode[0],'get'));
                }

                    foreach ($sql['clientAdress'] as $val){
                        if ($val['id'] == $explode[2]){
                            $adress = $val['adress'];
                        }
                    }

                $sql['template'] = 'page_client';
                $sql['title'] = "Рассчет сметы натяжных потолков по адресу ".$adress;
                $sql['description'] = "Рассчет сметы натяжных потолков по адресу ".$adress." с описанием видов работ и материалов";
                $sql['pathHeadJs'] = [
                  'head'=> 'headClient.php',
                  'footer'=> 'footerClient.php'
                ];

                return $sql;
            }else{
              
                $sql['template'] = 'authorization';

            }
        }


         $sql['clientAdress'] = json_encode($sql['clientAdress']);

        $sql['manufacturera'] = json_encode($this->sql->query("SELECT * FROM `room`"));
        $sql['unit'] = $this->sql->query("SELECT * FROM `unit_of_measurement`");
        $sql['texture'] = json_encode($this->sql->query("SELECT * FROM `room`"));
        $sql['types_of_work'] = $this->sql->query("SELECT `types_of_work`.* ,`groups`.`name` as 'namegroops' FROM `types_of_work` LEFT JOIN `groups` ON `types_of_work`.`group_id` = `groups`.`id`");
        $sql['groops'] = $this->sql->query("SELECT * FROM `groups`");
        $sql['communications'] = $this->sql->query("SELECT * FROM `communications`");
        $sql['kinds'] = $this->sql->query("SELECT * FROM `kinds`");

        $sql['unit'] = json_encode($sql['unit']);
        $sql['types_of_work'] = json_encode($sql['types_of_work']);
        $sql['groops'] = json_encode($sql['groops']);
        $sql['communications'] = json_encode($sql['communications']);
        $sql['kinds'] = json_encode($sql['kinds']);

        return $sql;
    }

}