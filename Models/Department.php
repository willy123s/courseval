<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Department extends Model
{
    protected $id;
    protected $department;
    protected $description;

    public function __construct($id,$department,$description)
    {
           $this->id=$id;
    $this->department=$department;
    $this->description=$description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDepartment()
    {
        return $this->department;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setDepartment($value)
    {
        $this->department = $value;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public static function getAll(){
       
        $m = Model::getInstance();
        $list = [];
        $r = $m->all('departments');
        if($r){
            foreach($r as $v){
                $data = new Department(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value){
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('departments','id', $value);
        if($r){
            
            $data = new Department(...$r);
            
        }
        return $data;
    }

    public function save(){
        $m = Model::getInstance();
        if($this->id){
            $query = 'UPDATE departments SET department=:department,description=:description WHERE id=:id';
            $params = array(':id'=>$this->id,':department'=>$this->department,':description'=>$this->description);
            $result = $m->executeQuery($query,$params);
            return $result->stmt->rowCount();
        }else{
            $query = 'INSERT INTO departments VALUES (:id,:department,:description)';
            $params = array(':id'=>$this->id,':department'=>$this->department,':description'=>$this->description);
            $result = $m->executeQuery($query,$params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if($this->id){
            $stmt=$m->delete('departments',$this->id);
            return $stmt->stmt->rowCount();
        }
    }
}

