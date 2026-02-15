<?php

namespace classed;

use classed\RouteException;

class Db
{


    public function __construct(){
        $this->sql = @new \mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        
        if($this->sql->connect_error){

            throw new DbException('Ошибка подключения к базе к данных: ' . $this->sql->connect_errno . ' ' . $this->sql->connect_error,3);
        }

        $this->sql->query('SET NAMES UTF8');

        return  $this->sql;
    }

    public function query( $query,$role = false){
        if (!$query)return false;
        $result = $this->sql->query($query);

        $findme   = ['UPDATE','INSERT'];
        foreach ($findme as $value){
            $pos = strpos($query, $value);

            if ($pos !== false && $result && !$role) {
                return true;
            }
        }

        if (!$role){

            if($result->num_rows != 0){
                $res = [];
                for ($i = 0; $i < $result->num_rows;$i++){
                    $res[] = $result->fetch_assoc();
                }
                return $res;
            }else{
                return false;
            }
        }elseif($role == 'assoc'){
            if($result->num_rows){
                return $result->fetch_assoc();
            }
        }elseif($role == 'id'){
            return $id = $this->sql->insert_id;
        }else{
            if ($result){
                return $result;
            }
        }
        if ($result->num_rows === 0)return false;
    }
    public function queryCount( $query){

        $result = $this->sql->query($query);

        if(!$result->num_rows){
            throw new RouteException('Не корректный запрос '.$query,1);

        }else{
            return  $result->num_rows;
        }

    }
}