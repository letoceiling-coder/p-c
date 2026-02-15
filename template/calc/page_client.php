<?php
if ($this->urlArray[1] == 'pro'){
    if (@!include_once "template/calc/smetaPro/".$this->urlArray[2].".php"){
        

        include_once "template/calc/authorization.php";
    }
}else{
    if (@!include_once "template/calc/smetaClientov/".$this->urlArray[1].".php"){


        include_once "template/calc/authorization.php";
    }
}


?>
