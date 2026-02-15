<?php


namespace classed;


class PluginsController extends BaseController
{
public function __construct()
{
}
    public function towns(){
         
       return $this->towns = $this->sql->query("SELECT * FROM town");
    }
    public function menu(){
        return  $this->menu = $this->brute_force_array($this->sql->query("SELECT `level_menu`,`level_priority`,`name`,`title` FROM `{$this->settings['default']['table']}`"));

    }
    public function town(){
        $this->path = '/';
        $this->town = $this->searchStr(self::towns(),$this->urlArray[0]);
          if (!$this->town ){
              if ($_SESSION['town']){
                  $this->town = $this->searchStr(self::towns(),$_SESSION['town']['domen_city']);
              }else{
                  $town = GetregionController::get();

                  if ($this->searchStr(self::towns(),$town['city'])){
                      $this->town = $this->searchStr(self::towns(),$town);
                  }else{
                      $this->town = $this->searchStr(self::towns(),$this->settings['default']['town']);
                  }

              }


          }else{
              $this->path = '/'.$this->urlArray[0].'/';
              array_shift($this->urlArray);

          }

        $_SESSION['town'] = $this->town;
       
          return $this->town;

    }
    public function podDomenRedirect(){
        $host  = $_SERVER['HTTP_HOST'];
            $host = str_replace("www.", "", $host); // не считаем www. поддоменом
            str_replace(".", "", $host, $count);

            if ($count > 1){
                $host = explode('.',$_SERVER['HTTP_HOST'])[0];
                
                $this->town = $this->searchStr(self::towns(),$host);
            }

    }
}
