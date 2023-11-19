<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Schoolyear extends Model
{
    protected $id;
    protected $schoolyear;
    protected $status;

    public function __construct($id, $schoolyear, $status)
    {
        $this->id = $id;
        $this->schoolyear = $schoolyear;
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSchoolyear()
    {
        return $this->schoolyear;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setSchoolyear($value)
    {
        $this->schoolyear = $value;
    }

    public function setStatus($value)
    {
        $this->status = $value;
    }

    public static function getAll()
    {

        $m = Model::getInstance();
        $list = [];
        $r = $m->executeQuery('SELECT * FROM schoolyears ORDER BY schoolyear desc');
        if ($r) {
            $r = $r->stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($r as $v) {
                $data = new Schoolyear(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('schoolyears', 'id', $value);
        if ($r) {

            $data = new Schoolyear(...$r);
        }
        return $data;
    }

    public function save()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $query = 'UPDATE schoolyears SET schoolyear=:schoolyear,status=:status WHERE id=:id';
            $params = array(':id' => $this->id, ':schoolyear' => $this->schoolyear, ':status' => $this->status);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO schoolyears VALUES (:id,:schoolyear,:status)';
            $params = array(':id' => $this->id, ':schoolyear' => $this->schoolyear, ':status' => $this->status);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $stmt = $m->delete('schoolyears', $this->id);
            return $stmt->stmt->rowCount();
        }
    }
}
