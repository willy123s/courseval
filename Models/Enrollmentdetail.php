<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Enrollmentdetail extends Model
{
    protected $id;
    protected $enrollmentId;
    protected $currDetId;
    protected $addedBy;
    protected $addedAt;

    public function __construct($id,$enrollmentId,$currDetId,$addedBy,$addedAt)
    {
           $this->id=$id;
    $this->enrollmentId=$enrollmentId;
    $this->currDetId=$currDetId;
    $this->addedBy=$addedBy;
    $this->addedAt=$addedAt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEnrollmentId()
    {
        return $this->enrollmentId;
    }

    public function getCurrDetId()
    {
        return $this->currDetId;
    }

    public function getAddedBy()
    {
        return $this->addedBy;
    }

    public function getAddedAt()
    {
        return $this->addedAt;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setEnrollmentId($value)
    {
        $this->enrollmentId = $value;
    }

    public function setCurrDetId($value)
    {
        $this->currDetId = $value;
    }

    public function setAddedBy($value)
    {
        $this->addedBy = $value;
    }

    public function setAddedAt($value)
    {
        $this->addedAt = $value;
    }

    public static function getAll(){
       
        $m = Model::getInstance();
        $list = [];
        $r = $m->all('enrollmentdetails');
        if($r){
            foreach($r as $v){
                $data = new Enrollmentdetail(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value){
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('enrollmentdetails','id', $value);
        if($r){
            
            $data = new Enrollmentdetail(...$r);
            
        }
        return $data;
    }

    public function save(){
        $m = Model::getInstance();
        if($this->id){
            $query = 'UPDATE enrollmentdetails SET enrollmentId=:enrollmentId,currDetId=:currDetId,addedBy=:addedBy,addedAt=:addedAt WHERE id=:id';
            $params = array(':id'=>$this->id,':enrollmentId'=>$this->enrollmentId,':currDetId'=>$this->currDetId,':addedBy'=>$this->addedBy,':addedAt'=>$this->addedAt);
            $result = $m->executeQuery($query,$params);
            return $result->stmt->rowCount();
        }else{
            $query = 'INSERT INTO enrollmentdetails VALUES (:id,:enrollmentId,:currDetId,:addedBy,:addedAt)';
            $params = array(':id'=>$this->id,':enrollmentId'=>$this->enrollmentId,':currDetId'=>$this->currDetId,':addedBy'=>$this->addedBy,':addedAt'=>$this->addedAt);
            $result = $m->executeQuery($query,$params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if($this->id){
            $stmt=$m->delete('enrollmentdetails',$this->id);
            return $stmt->stmt->rowCount();
        }
    }
}

