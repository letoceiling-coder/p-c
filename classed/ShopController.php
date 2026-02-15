<?php

namespace classed;

class ShopController extends BaseController
{


    public function defaultPage($data){

        $sql = $this->getSqlShop($data);
        if (!$sql ){
            $sql['template'] = 'error';
        }
        if (!$sql['template'])$sql['template'] = 'page';
        return $sql;
    }
}