<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Proof extends Model
{
    protected $id;
    protected $userId;
    protected $yearid;
    protected $semester;
    protected $filename;

    public function __construct($id, $userId, $yearid, $semester, $filename)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->yearid = $yearid;
        $this->semester = $semester;
        $this->filename = $filename;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getYearid()
    {
        return $this->yearid;
    }

    public function getSemester()
    {
        return $this->semester;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setUserId($value)
    {
        $this->userId = $value;
    }

    public function setYearid($value)
    {
        $this->yearid = $value;
    }

    public function setSemester($value)
    {
        $this->semester = $value;
    }

    public function setFilename($value)
    {
        $this->filename = $value;
    }

    public function getSY()
    {
        $sy = Schoolyear::getById($this->yearid);
        return $sy->getSchoolyear();
    }
    public function getSem()
    {
        $sem = Semester::getById($this->semester);
        return $sem->getSem();
    }

    public static function getByUserId($userId)
    {

        $m = Model::getInstance();
        $list = [];
        $query = "SELECT * FROM proofs WHERE userId=:userid";
        $param = array("userid" => $userId);
        $r = $m->executeQuery($query, $param);
        if (is_object($r)) {
            $r = $r->stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($r as $v) {
                $data = new Proof(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }
    public static function getAll()
    {

        $m = Model::getInstance();
        $list = [];
        $r = $m->all('proofs');
        if ($r) {
            foreach ($r as $v) {
                $data = new Proof(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('proofs', 'id', $value);
        if ($r) {

            $data = new Proof(...$r);
        }
        return $data;
    }

    public function save()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $query = 'UPDATE proofs SET userId=:userId,yearid=:yearid,semester=:semester,filename=:filename WHERE id=:id';
            $params = array(':id' => $this->id, ':userId' => $this->userId, ':yearid' => $this->yearid, ':semester' => $this->semester, ':filename' => $this->filename);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO proofs VALUES (:id,:userId,:yearid,:semester,:filename)';
            $params = array(':id' => $this->id, ':userId' => $this->userId, ':yearid' => $this->yearid, ':semester' => $this->semester, ':filename' => $this->filename);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $stmt = $m->delete('proofs', $this->id);
            return $stmt->stmt->rowCount();
        }
    }
}
