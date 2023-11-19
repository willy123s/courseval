<?php

namespace Makkari\Models;

use Makkari\Controllers\Currdetails;
use Makkari\Models\Model;

class Prerequisite extends Model
{
    protected $id;
    protected $currDetailsId;
    protected $prereq;
    protected $type;

    public function __construct($id, $currDetailsId, $prereq, $type)
    {
        $this->id = $id;
        $this->currDetailsId = $currDetailsId;
        $this->prereq = $prereq;
        $this->type = $type;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCurrDetailsId()
    {
        return $this->currDetailsId;
    }

    public function getPrereq()
    {
        return $this->prereq;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setCurrDetailsId($value)
    {
        $this->currDetailsId = $value;
    }

    public function setPrereq($value)
    {
        $this->prereq = $value;
    }

    public function setType($value)
    {
        $this->type = $value;
    }
    public function getCode()
    {
        $subject = Curriculumdetail::getById($this->prereq);
        return $subject->getSubject()->getSubjectCode();
    }
    public static function ifExists($currDetailsId, $prereq)
    {
        $m = Model::getInstance();
        $r = $m->executeQuery(
            'SELECT * FROM prerequisites WHERE currDetailsId=:currDetId and prereq=:prereq',
            array(
                ":currDetId" => $currDetailsId,
                ":prereq" => $prereq
            )
        );
        return $r->stmt->rowCount();
    }
    public static function getAllByPrereq($currDetailsId)
    {
        $m = Model::getInstance();
        $list = [];
        $r = $m->executeQuery('SELECT * FROM prerequisites WHERE currDetailsId=:currDetId', array(":currDetId" => $currDetailsId));
        if ($r->stmt->rowCount()) {
            $r = $r->stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($r as $v) {
                $data = new Prerequisite(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }
    public static function getAllByCurr($currDetailsId)
    {
        $m = Model::getInstance();
        $list = [];
        $r = $m->executeQuery('SELECT * FROM prerequisites WHERE currDetailsId=:currDetId', array(":currDetId" => $currDetailsId));
        if ($r->stmt->rowCount()) {
            $r = $r->stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($r as $v) {
                $data = new Prerequisite(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getAll()
    {

        $m = Model::getInstance();
        $list = [];
        $r = $m->all('prerequisites');
        if ($r) {
            foreach ($r as $v) {
                $data = new Prerequisite(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('prerequisites', 'id', $value);
        if ($r) {

            $data = new Prerequisite(...$r);
        }
        return $data;
    }

    public function save()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $query = 'UPDATE prerequisites SET currDetailsId=:currDetailsId,prereq=:prereq,type=:type WHERE id=:id';
            $params = array(':id' => $this->id, ':currDetailsId' => $this->currDetailsId, ':prereq' => $this->prereq, ':type' => $this->type);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO prerequisites VALUES (:id,:currDetailsId,:prereq,:type)';
            $params = array(':id' => $this->id, ':currDetailsId' => $this->currDetailsId, ':prereq' => $this->prereq, ':type' => $this->type);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $stmt = $m->delete('prerequisites', $this->id);
            return $stmt->stmt->rowCount();
        }
    }
}
