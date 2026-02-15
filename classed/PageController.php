<?php

namespace classed;

 class PageController extends BaseController
{

    public function __construct(){

    }
    public function defaultPage(){
       
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
            $sql['jsons_template']['priceBaner'] = 205;
        }


        return $sql;
    }
}