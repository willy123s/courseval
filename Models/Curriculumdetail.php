<?php

namespace Makkari\Models;

use Makkari\Controllers\Subjects;
use Makkari\Models\Model;

class Curriculumdetail extends Model
{
    protected $id;
    protected $currId;
    protected $subId;
    protected $yearId;
    protected $semId;

    public function __construct($id, $currId, $subId, $yearId, $semId)
    {
        $this->id = $id;
        $this->currId = $currId;
        $this->subId = $subId;
        $this->yearId = $yearId;
        $this->semId = $semId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCurrId()
    {
        return $this->currId;
    }

    public function getSubId()
    {
        return $this->subId;
    }

    public function getYearId()
    {
        return $this->yearId;
    }

    public function getSemId()
    {
        return $this->semId;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setCurrId($value)
    {
        $this->currId = $value;
    }

    public function setSubId($value)
    {
        $this->subId = $value;
    }

    public function setYearId($value)
    {
        $this->yearId = $value;
    }

    public function setSemId($value)
    {
        $this->semId = $value;
    }

    public function getSubject()
    {
        $subject = Subject::getById($this->subId);
        return $subject;
    }
    public function getSem()
    {
        $sem = Semester::getById($this->semId);
        return $sem;
    }

    public static function getByCurrIdLevel($id, $lvl)
    {
        $m = Model::getInstance();
        $list = [];
        $r = $m->executeQuery('SELECT * FROM curriculumdetails WHERE currId=:id and yearId=:lvl', array(":id" => $id, ":lvl" => $lvl));
        if ($r) {
            $r = $r->stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($r as $v) {
                $data = new Curriculumdetail(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }
    public static function getAll()
    {

        $m = Model::getInstance();
        $list = [];
        $r = $m->all('curriculumdetails');
        if ($r) {
            foreach ($r as $v) {
                $data = new Curriculumdetail(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('curriculumdetails', 'id', $value);
        if ($r) {

            $data = new Curriculumdetail(...$r);
        }
        return $data;
    }

    public function save()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $query = 'UPDATE curriculumdetails SET currId=:currId,subId=:subId,yearId=:yearId,semId=:semId WHERE id=:id';
            $params = array(':id' => $this->id, ':currId' => $this->currId, ':subId' => $this->subId, ':yearId' => $this->yearId, ':semId' => $this->semId);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO curriculumdetails VALUES (:id,:currId,:subId,:yearId,:semId)';
            $params = array(':id' => $this->id, ':currId' => $this->currId, ':subId' => $this->subId, ':yearId' => $this->yearId, ':semId' => $this->semId);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $stmt = $m->delete('curriculumdetails', $this->id);
            return $stmt->stmt->rowCount();
        }
    }
}
