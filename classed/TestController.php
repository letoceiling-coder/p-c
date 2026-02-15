<?php

namespace classed;

class TestController extends BaseController
{

    public function __construct(){

    }
    public function defaultPage(){


                $sql['template'] = 'page';
        $this->pathTable = 'test';

        return $sql;
    }
}