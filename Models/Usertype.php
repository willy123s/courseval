<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Usertype extends Model
{
    protected $id;
    protected $utype;

    public function __construct($id,$utype)
    {
           $this->id=$id;
    $this->utype=$utype;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUtype()
    {
        return $this->utype;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setUtype($value)
    {
        $this->utype = $value;
    }

    public static function getAll(){
       
        $m = Model::getInstance();
        $list = [];
        $r = $m->all('usertypes');
        if($r){
            foreach($r as $v){
                $data = new Usertype(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value){
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('usertypes','id', $value);
        if($r){
            
            $data = new Usertype(...$r);
            
        }
        return $data;
    }

    public function save(){
        $m = Model::getInstance();
        if($this->id){
            $query = 'UPDATE usertypes SET utype=:utype WHERE id=:id';
            $params = array(':id'=>$this->id,':utype'=>$this->utype);
            $result = $m->executeQuery($query,$params);
            return $result->stmt->rowCount();
        }else{
            $query = 'INSERT INTO usertypes VALUES (:id,:utype)';
            $params = array(':id'=>$this->id,':utype'=>$this->utype);
            $result = $m->executeQuery($query,$params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if($this->id){
            $stmt=$m->delete('usertypes',$this->id);
            return $stmt->stmt->rowCount();
        }
    }
}

