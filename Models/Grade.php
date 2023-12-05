<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Grade extends Model
{
    protected $id;
    protected $studId;
    protected $currDetailsId;
    protected $grade;
    protected $semester;
    protected $schoolyear;
    protected $isConfirmed;

    public function __construct($id, $studId, $currDetailsId, $grade, $semester, $schoolyear, $isConfirmed)
    {
        $this->id = $id;
        $this->studId = $studId;
        $this->currDetailsId = $currDetailsId;
        $this->grade = $grade;
        $this->semester = $semester;
        $this->schoolyear = $schoolyear;
        $this->isConfirmed = $isConfirmed;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStudId()
    {
        return $this->studId;
    }

    public function getCurrDetailsId()
    {
        return $this->currDetailsId;
    }

    public function getGrade()
    {
        return $this->grade;
    }

    public function getSemester()
    {
        return $this->semester;
    }

    public function getSchoolyear()
    {
        return $this->schoolyear;
    }

    public function getIsConfirmed()
    {
        return $this->isConfirmed;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setStudId($value)
    {
        $this->studId = $value;
    }

    public function setCurrDetailsId($value)
    {
        $this->currDetailsId = $value;
    }

    public function setGrade($value)
    {
        $this->grade = $value;
    }

    public function setSemester($value)
    {
        $this->semester = $value;
    }

    public function setSchoolyear($value)
    {
        $this->schoolyear = $value;
    }

    public function setIsConfirmed($value)
    {
        $this->isConfirmed = $value;
    }

    public function getSchoolyearInfo()
    {
        $sy = Schoolyear::getById($this->schoolyear);
        return $sy;
    }
    public function getSemesterInfo()
    {
        $sem = Semester::getById($this->semester);
        return $sem;
    }
    public static function getGradeByStudentAndSubject($studid, $currid)
    {
        $m = Model::getInstance();
        $list = [];
        $r = $m->executeQuery('SELECT * FROM grades WHERE studId =:studId and currDetailsId=:currDetId', array(":studId" => $studid, ":currDetId" => $currid));
        if ($r) {
            if ($r->stmt->rowCount() > 0) {
                $r = $r->stmt->fetchAll(\PDO::FETCH_ASSOC);
                foreach ($r as $v) {
                    $data = new Grade(...$v);
                    $list[] = $data;
                }
            }
        }
        return $list;
    }

    public static function getAll()
    {
        $m = Model::getInstance();
        $list = [];
        $r = $m->all('grades');
        if ($r) {
            foreach ($r as $v) {
                $data = new Grade(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getById($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('grades', 'id', $value);
        if ($r) {

            $data = new Grade(...$r);
        }
        return $data;
    }

    public function save()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $query = 'UPDATE grades SET studId=:studId,currDetailsId=:currDetailsId,grade=:grade,semester=:semester,schoolyear=:schoolyear,isConfirmed=:isConfirmed WHERE id=:id';
            $params = array(':id' => $this->id, ':studId' => $this->studId, ':currDetailsId' => $this->currDetailsId, ':grade' => $this->grade, ':semester' => $this->semester, ':schoolyear' => $this->schoolyear, ':isConfirmed' => $this->isConfirmed);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO grades VALUES (:id,:studId,:currDetailsId,:grade,:semester,:schoolyear,:isConfirmed)';
            $params = array(':id' => $this->id, ':studId' => $this->studId, ':currDetailsId' => $this->currDetailsId, ':grade' => $this->grade, ':semester' => $this->semester, ':schoolyear' => $this->schoolyear, ':isConfirmed' => $this->isConfirmed);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $stmt = $m->delete('grades', $this->id);
            return $stmt->stmt->rowCount();
        }
    }
}
