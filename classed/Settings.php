<?php


namespace classed;


class Settings
{
use Singleton;

protected $settings = [
  'config' => [
      'email' => true,
      'sms' => false
  ]
];
protected $months = [
    '01' =>"января",
    '02' =>"февраля",
    '03' =>"марта",
    '04' =>"апреля",
    '05' =>"мая",
    '06' =>"июня",
    '07' =>"июля",
    '08' =>"августа",
    '09' =>"сентября",
    '10' =>"октября",
    '11' =>"ноября",
    '12' =>"декабря"
];


    static public function get($property){
        return self::instance()->$property;
    }
}