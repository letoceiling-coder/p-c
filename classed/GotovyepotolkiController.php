<?php

namespace classed;

class GotovyepotolkiController extends BaseController
{


    public function __construct(){

    }
    public function defaultPage(){
        $this->getPlugin();
        $this->pathTable = 'gotovye-potolki';
        $sql = $this->getSqlCards();
        if (!$sql ){
            $sql['template'] = 'error';
        }
        return $sql;
    }
    public function page(){
        $this->getPlugin();
        $sql = $this->getSql($this);
        if (!$sql ){
            $sql['template'] = 'error';
        }
        return $sql;
    }

}