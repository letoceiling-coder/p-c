<?php

switch ($this->template.'-'.$this->pathTable){
    case 'page-shop':
        $this->route["name_title"] = 'Купить '.mb_strtolower($this->route["h3"]).' в городе '.$this->town["city-rus-rod"];
        $this->route["description"] = $this->str_transformations($this->route["description"],$this->town);
        $this->route["keywords"] = $this->str_transformations($this->settings['defaultKeywords'],$this->town);
        break;
    case 'error-url':
        $this->route["name_title"] = "Ой вы попали не туда";
        $this->route["description"] = "Страница которую вы ищете, недоступна или перенесена.";
        $this->route["keywords"] = "Not Found";
        header("HTTP/1.0 404 Not Found");
        break;

}
