<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Enrollment extends Model
{
    protected $id;
    protected $studId;
    protected $syId;
    protected $semId;
    protected $createdBy;
    protected $createdAt;

    public function __construct($id, $studId, $syId, $semId, $createdBy, $createdAt)
    {
        $this->id = $id;
        $this->studId = $studId;
        $this->syId = $syId;
        $this->semId = $semId;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStudId()
    {
        return $this->studId;
    }

    public function getSyId()
    {
        return $this->syId;
    }

    public function getSemId()
    {
        return $this->semId;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setStudId($value)
    {
        $this->studId = $value;
    }

    public function setSyId($value)
    {
        $this->syId = $value;
    }

    public function setSemId($value)
    {
        $this->semId = $value;
    }

    public function setCreatedBy($value)
    {
        $this->createdBy = $value;
    }

    public function setCreatedAt($value)
    {
        $this->createdAt = $value;
    }

    public static function getAll()
    {

        $m = Model::getInstance();
        $list = [];
        $r = $m->all('enrollments');
        if ($r) {
            foreach ($r as $v) {
                $data = new Enrollment(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('enrollments', 'id', $value);
        if ($r) {

            $data = new Enrollment(...$r);
        }
        return $data;
    }

    public function save()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $query = 'UPDATE enrollments SET studId=:studId,syId=:syId,semId=:semId,createdBy=:createdBy,createdAt=:createdAt WHERE id=:id';
            $params = array(':id' => $this->id, ':studId' => $this->studId, ':syId' => $this->syId, ':semId' => $this->semId, ':createdBy' => $this->createdBy, ':createdAt' => $this->createdAt);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO enrollments VALUES (:id,:studId,:syId,:semId,:createdBy,:createdAt)';
            $params = array(':id' => $this->id, ':studId' => $this->studId, ':syId' => $this->syId, ':semId' => $this->semId, ':createdBy' => $this->createdBy, ':createdAt' => $this->createdAt);
            $result = $m->executeQuery($query, $params);
            return $result->lastInsertId;
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $stmt = $m->delete('enrollments', $this->id);
            return $stmt->stmt->rowCount();
        }
    }
}
