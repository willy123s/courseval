<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Cours extends Model
{
    protected $id;
    protected $course;
    protected $description;

    public function __construct($id, $course, $description)
    {
        $this->id = $id;
        $this->course = $course;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCourse()
    {
        return $this->course;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setCourse($value)
    {
        $this->course = $value;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public static function getAll()
    {

        $m = Model::getInstance();
        $list = [];
        $r = $m->all('courses');
        if ($r) {
            foreach ($r as $v) {
                $data = new Cours(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('courses', 'id', $value);
        if ($r) {

            $data = new Cours(...$r);
        }
        return $data;
    }

    public function save()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $query = 'UPDATE courses SET course=:course,description=:description WHERE id=:id';
            $params = array(':id' => $this->id, ':course' => $this->course, ':description' => $this->description);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO courses VALUES (:id,:course,:description)';
            $params = array(':id' => $this->id, ':course' => $this->course, ':description' => $this->description);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $stmt = $m->delete('courses', $this->id);
            return $stmt->stmt->rowCount();
        }
    }
}
