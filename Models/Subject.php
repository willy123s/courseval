<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Subject extends Model
{
    protected $id;
    protected $subjectCode;
    protected $description;
    protected $units;

    public function __construct($id, $subjectCode, $description, $units)
    {
        $this->id = $id;
        $this->subjectCode = $subjectCode;
        $this->description = $description;
        $this->units = $units;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getUnits()
    {
        return $this->units;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setSubjectCode($value)
    {
        $this->subjectCode = $value;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function setUnits($value)
    {
        $this->units = $value;
    }


    public static function getByKeyButNotIn($currId, $key)
    {
        $m = Model::getInstance();
        $list = [];
        $r = $m->executeQuery('SELECT * FROM subjects WHERE (subjectCode like :key or description like :key) and id not in (SELECT subId from curriculumdetails WHERE currId=:currId);', array(":currId" => $currId, ":key" => "%" . $key . "%"));
        if ($r) {
            $r = $r->stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($r as $v) {
                $data = new Subject(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }
    public static function  getAllButNotIn($currId)
    {
        $m = Model::getInstance();
        $list = [];
        $r = $m->executeQuery('SELECT * FROM subjects WHERE id not in (SELECT subId from curriculumdetails WHERE currId=:currId)', array(":currId" => $currId));
        if ($r) {
            $r = $r->stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($r as $v) {
                $data = new Subject(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }
    public static function getAll()
    {

        $m = Model::getInstance();
        $list = [];
        $r = $m->all('subjects');
        if ($r) {
            foreach ($r as $v) {
                $data = new Subject(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('subjects', 'id', $value);
        if ($r) {

            $data = new Subject(...$r);
        }
        return $data;
    }

    public function save()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $query = 'UPDATE subjects SET subjectCode=:subjectCode,description=:description,units=:units WHERE id=:id';
            $params = array(':id' => $this->id, ':subjectCode' => $this->subjectCode, ':description' => $this->description, ':units' => $this->units);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO subjects VALUES (:id,:subjectCode,:description,:units)';
            $params = array(':id' => $this->id, ':subjectCode' => $this->subjectCode, ':description' => $this->description, ':units' => $this->units);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $stmt = $m->delete('subjects', $this->id);
            return $stmt->stmt->rowCount();
        }
    }
}
