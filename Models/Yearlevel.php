<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Yearlevel extends Model
{
    protected $id;
    protected $year;

    public function __construct($id,$year)
    {
           $this->id=$id;
    $this->year=$year;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setYear($value)
    {
        $this->year = $value;
    }

    public static function getAll(){
       
        $m = Model::getInstance();
        $list = [];
        $r = $m->all('yearlevels');
        if($r){
            foreach($r as $v){
                $data = new Yearlevel(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value){
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('yearlevels','id', $value);
        if($r){
            
            $data = new Yearlevel(...$r);
            
        }
        return $data;
    }

    public function save(){
        $m = Model::getInstance();
        if($this->id){
            $query = 'UPDATE yearlevels SET year=:year WHERE id=:id';
            $params = array(':id'=>$this->id,':year'=>$this->year);
            $result = $m->executeQuery($query,$params);
            return $result->stmt->rowCount();
        }else{
            $query = 'INSERT INTO yearlevels VALUES (:id,:year)';
            $params = array(':id'=>$this->id,':year'=>$this->year);
            $result = $m->executeQuery($query,$params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if($this->id){
            $stmt=$m->delete('yearlevels',$this->id);
            return $stmt->stmt->rowCount();
        }
    }
}

