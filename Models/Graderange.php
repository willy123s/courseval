<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Graderange extends Model
{
    protected $id;
    protected $grade;
    protected $description;

    public function __construct($id,$grade,$description)
    {
           $this->id=$id;
    $this->grade=$grade;
    $this->description=$description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getGrade()
    {
        return $this->grade;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setGrade($value)
    {
        $this->grade = $value;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public static function getAll(){
       
        $m = Model::getInstance();
        $list = [];
        $r = $m->all('graderange');
        if($r){
            foreach($r as $v){
                $data = new Graderange(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value){
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('graderange','id', $value);
        if($r){
            
            $data = new Graderange(...$r);
            
        }
        return $data;
    }

    public function save(){
        $m = Model::getInstance();
        if($this->id){
            $query = 'UPDATE graderange SET grade=:grade,description=:description WHERE id=:id';
            $params = array(':id'=>$this->id,':grade'=>$this->grade,':description'=>$this->description);
            $result = $m->executeQuery($query,$params);
            return $result->stmt->rowCount();
        }else{
            $query = 'INSERT INTO graderange VALUES (:id,:grade,:description)';
            $params = array(':id'=>$this->id,':grade'=>$this->grade,':description'=>$this->description);
            $result = $m->executeQuery($query,$params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if($this->id){
            $stmt=$m->delete('graderange',$this->id);
            return $stmt->stmt->rowCount();
        }
    }
}

