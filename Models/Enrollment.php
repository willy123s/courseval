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
    protected $status;

    public function __construct($id, $studId, $syId, $semId, $createdBy, $createdAt, $status)
    {
        $this->id = $id;
        $this->studId = $studId;
        $this->syId = $syId;
        $this->semId = $semId;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
        $this->status = $status;
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

    public function getStatus()
    {
        return $this->status;
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

    public function setStatus($value)
    {
        $this->status = $value;
    }
    public function getSchoolYear()
    {
        $sy = Schoolyear::getById($this->syId);
        return $sy;
    }
    public function getDetails()
    {
        $details = Enrollmentdetail::getByEnrollment($this->id);
        return $details;
    }
    public function getSem()
    {
        $sem = Semester::getById($this->semId);
        return $sem;
    }
    public function getStudent()
    {
        $stud = Student::getById($this->studId);
        return $stud;
    }
    public static function getCourseCheked($syid, $semid, $createdby)
    {

        $m = Model::getInstance();
        $params = array(
            ":createdby" => $createdby,
            ":syid" => $syid,
            ":semid" => $semid,
        );
        $list = [];
        $r = $m->executeQuery('SELECT * FROM enrollments WHERE (syId=:syid and semId=:semid) and createdBy=:createdby order by id desc', $params);
        if ($r) {
            $r = $r->stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($r as $v) {
                $data = new Enrollment(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }
    public static function ifExist($studId, $semid, $syid)
    {
        $m = Model::getInstance();
        $data = NULL;
        $params = array(
            ":studid" => $studId,
            ":semid" => $semid,
            ":syid" => $syid,
        );
        $r = $m->executeQuery('SELECT * FROM enrollments WHERE studId=:studid and syId=:syid and semId=:semid order by id desc limit 1', $params);
        if ($r) {
            if ($r->stmt->rowCount()) {
                $v = $r->stmt->fetch(\PDO::FETCH_ASSOC);
                $data = new Enrollment(...$v);
            }
        }
        return $data;
    }
    public static function getPendingByStudent($studId, $semid, $syid, $status)
    {
        $m = Model::getInstance();
        $params = array(
            ":studid" => $studId,
            ":semid" => $semid,
            ":syid" => $syid,
            ":status" => $status,
        );
        $data = NULL;
        $r = $m->executeQuery('SELECT * FROM enrollments WHERE studId=:studid and syId=:syid and semId=:semid and status=:status order by id desc limit 1', $params);
        if ($r) {
            if ($r->stmt->rowCount()) {
                $v = $r->stmt->fetch(\PDO::FETCH_ASSOC);
                $data = new Enrollment(...$v);
            }
        }
        return $data;
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
            $query = 'UPDATE enrollments SET studId=:studId,syId=:syId,semId=:semId,createdBy=:createdBy,createdAt=:createdAt,status=:status WHERE id=:id';
            $params = array(':id' => $this->id, ':studId' => $this->studId, ':syId' => $this->syId, ':semId' => $this->semId, ':createdBy' => $this->createdBy, ':createdAt' => $this->createdAt, ':status' => $this->status);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO enrollments VALUES (:id,:studId,:syId,:semId,:createdBy,:createdAt,:status)';
            $params = array(':id' => $this->id, ':studId' => $this->studId, ':syId' => $this->syId, ':semId' => $this->semId, ':createdBy' => $this->createdBy, ':createdAt' => $this->createdAt, ':status' => $this->status);
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
