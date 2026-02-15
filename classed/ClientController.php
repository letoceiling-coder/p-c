<?php

namespace classed;

class ClientController extends BaseController
{

    public function __construct(){

    }
    public function defaultPage(){
        $gets = "";
        if ($_COOKIE['client']) $this->client = $this->getClient();
        if ($this->client && !$this->urlArray[1]){
            $sql['client'] = json_encode($this->getSqlClient($this->client));
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

                $explode = explode('-',$this->urlArray[1]);
                $sql['client'] = $this->getSqlClient($explode[0],$explode[1]);
                $sql['setClient'] = (AjaxController::getClient($explode[1], $explode[2], $explode[0],'get'));
                $sql['template'] = 'page';
                $sql['client'] = json_encode($sql['client']);
                if(!$sql['setClient']){
                    $sql['template'] = 'authorization';

                }else{
                    $gets = " WHERE `client_id` = ".$explode[1];
                    $sql['setClient'] = json_encode($sql['setClient']);
                    $this->client = $explode[0];
                    $sql['title'] = 'title';
                }

            }else{
                $sql['template'] = 'authorization';

            }
        }

        $sql['base'] = json_encode($this->sql->query("SELECT * FROM `base`"));
        $sql['rooms'] = json_encode($this->sql->query("SELECT * FROM `room`"));

        $sql['clientAdress'] = $this->sql->query("SELECT * FROM `client_adress` $gets");
        $sql['title'] = "Рассчет сметы натяжных потолков по адресу ".$sql['clientAdress'][0]['adress'];
        $sql['description'] = "Рассчет сметы натяжных потолков по адресу ".$sql['clientAdress'][0]['adress']." с описанием видов работ и материалов";
        $sql['clientAdress'] = json_encode($sql['clientAdress']);

        $sql['manufacturera'] = json_encode($this->sql->query("SELECT * FROM `room`"));
        $sql['unit'] = $this->sql->query("SELECT * FROM `unit_of_measurement`");
        $sql['texture'] = json_encode($this->sql->query("SELECT * FROM `room`"));
        $sql['types_of_work'] = $this->sql->query("SELECT `types_of_work`.`id`,`types_of_work`.`property`, `types_of_work`.`group_id`, `types_of_work`.`kinds`, `types_of_work`.`name`, `types_of_work`.`nameas`, `types_of_work`.`id_unit_of_measurement`, `types_of_work`.`multiple`, `types_of_work`.`price`, `types_of_work`.`price_diler`, `types_of_work`.`price_montaj`, `types_of_work`.`description`, `types_of_work`.`photo` ,`groups`.`name` as 'namegroops' FROM `types_of_work` LEFT JOIN `groups` ON `types_of_work`.`group_id` = `groups`.`id`");
        $listGroops = [];
        foreach ($sql['types_of_work'] as $key=>$value){
            if ($listGroops[$value['namegroops']]){
                $listGroops[$value['namegroops']][] = $value;
            }else{
                $listGroops[$value['namegroops']][] = $value;
            }


        }
        $unit = [];
        foreach ($sql['unit'] as $key=>$val){
            $unit[$val['id']] = $val['name'];
        }
        $sql['unit'] = json_encode($unit);
        $sql['types_of_work'] = json_encode($listGroops);

        return $sql;
    }

}