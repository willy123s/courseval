<?php

namespace Makkari\Models;

use Makkari\Models\Model;
use stdClass;

class Curriculum extends Model
{
    protected $id;
    protected $name;
    protected $course_id;
    protected $sy;

    public function __construct($id, $name, $course_id, $sy)
    {
        $this->id = $id;
        $this->name = $name;
        $this->course_id = $course_id;
        $this->sy = $sy;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCourse_id()
    {
        return $this->course_id;
    }

    public function getSy()
    {
        return $this->sy;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    public function setCourse_id($value)
    {
        $this->course_id = $value;
    }

    public function setSy($value)
    {
        $this->sy = $value;
    }
    public  function getCourse()
    {
        $course = Cours::getById($this->course_id);
        return $course;
    }
    public function getSyDet()
    {
        $sy = Schoolyear::getById($this->sy);
        return $sy;
    }

    public static function getAll()
    {

        $m = Model::getInstance();
        $list = [];
        $r = $m->all('curriculums');
        if ($r) {
            foreach ($r as $v) {
                $data = new Curriculum(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('curriculums', 'id', $value);
        if ($r) {

            $data = new Curriculum(...$r);
        }
        return $data;
    }

    public function save()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $query = 'UPDATE curriculums SET name=:name,course_id=:course_id,sy=:sy WHERE id=:id';
            $params = array(':id' => $this->id, ':name' => $this->name, ':course_id' => $this->course_id, ':sy' => $this->sy);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO curriculums VALUES (:id,:name,:course_id,:sy)';
            $params = array(':id' => $this->id, ':name' => $this->name, ':course_id' => $this->course_id, ':sy' => $this->sy);
            $result = $m->executeQuery($query, $params);
            return $result;
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $stmt = $m->delete('curriculums', $this->id);
            return $stmt->stmt->rowCount();
        }
    }
}
