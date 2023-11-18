<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Semester extends Model
{
    protected $id;
    protected $sem;

    public function __construct($id,$sem)
    {
           $this->id=$id;
    $this->sem=$sem;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSem()
    {
        return $this->sem;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setSem($value)
    {
        $this->sem = $value;
    }

    public static function getAll(){
       
        $m = Model::getInstance();
        $list = [];
        $r = $m->all('semesters');
        if($r){
            foreach($r as $v){
                $data = new Semester(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value){
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('semesters','id', $value);
        if($r){
            
            $data = new Semester(...$r);
            
        }
        return $data;
    }

    public function save(){
        $m = Model::getInstance();
        if($this->id){
            $query = 'UPDATE semesters SET sem=:sem WHERE id=:id';
            $params = array(':id'=>$this->id,':sem'=>$this->sem);
            $result = $m->executeQuery($query,$params);
            return $result->stmt->rowCount();
        }else{
            $query = 'INSERT INTO semesters VALUES (:id,:sem)';
            $params = array(':id'=>$this->id,':sem'=>$this->sem);
            $result = $m->executeQuery($query,$params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if($this->id){
            $stmt=$m->delete('semesters',$this->id);
            return $stmt->stmt->rowCount();
        }
    }
}

