<?php

namespace Makkari\Models;

use Makkari\Controllers\Currdetails;
use Makkari\Models\Model;
use Makkari\Models\Curriculumdetail;

class Prerequisite extends Model
{
    protected $id;
    protected $currDetailsId;
    protected $prereq;
    protected $type;

    public function __construct($id = null, $currDetailsId, $prereq, $type)
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

        if ($subject && $subject->getSubject()) {
            return $subject->getSubject()->getSubjectCode();
        } else {
            return null; // Return null instead of 'Unknown Code' for better handling
        }
    }

    public static function ifExists($currDetailsId, $prereq)
    {
        $m = Model::getInstance();
        $r = $m->executeQuery(
            'SELECT * FROM prerequisites WHERE currDetailsId=:currDetId AND prereq=:prereq',
            [
                ":currDetId" => $currDetailsId,
                ":prereq" => $prereq
            ]
        );
        return $r->stmt->rowCount() > 0;
    }

    public static function getAllBy($field, $value)
    {
        $m = Model::getInstance();
        $list = [];
        $query = "SELECT * FROM prerequisites WHERE $field=:value";
        $r = $m->executeQuery($query, [":value" => $value]);
        if ($r->stmt->rowCount()) {
            $rows = $r->stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($rows as $v) {
                $data = new Prerequisite($v['id'], $v['currDetailsId'], $v['prereq'], $v['type']);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getAll()
    {
        $m = Model::getInstance();
        $list = [];
        $rows = $m->all('prerequisites');
        if ($rows) {
            foreach ($rows as $v) {
                $data = new Prerequisite($v['id'], $v['currDetailsId'], $v['prereq'], $v['type']);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($id)
    {
        $m = Model::getInstance();
        $r = $m->getOne('prerequisites', 'id', $id);
        if ($r) {
            return new Prerequisite($r['id'], $r['currDetailsId'], $r['prereq'], $r['type']);
        }
        return null;
    }

    public function save()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $query = 'UPDATE prerequisites SET currDetailsId=:currDetailsId, prereq=:prereq, type=:type WHERE id=:id';
            $params = [
                ':id' => $this->id,
                ':currDetailsId' => $this->currDetailsId,
                ':prereq' => $this->prereq,
                ':type' => $this->type
            ];
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO prerequisites (currDetailsId, prereq, type) VALUES (:currDetailsId, :prereq, :type)';
            $params = [
                ':currDetailsId' => $this->currDetailsId,
                ':prereq' => $this->prereq,
                ':type' => $this->type
            ];
            $result = $m->executeQuery($query, $params);
            if ($result->stmt->rowCount()) {
                $this->id = $m->lastInsertId(); // Update the id after insertion
                return $this->id;
            }
            return null;
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $stmt = $m->delete('prerequisites', $this->id);
            return $stmt->stmt->rowCount();
        }
        return 0;
    }
}
