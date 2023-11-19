<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Student extends Model
{
    protected $id;
    protected $studNo;
    protected $fname;
    protected $lname;
    protected $mname;
    protected $email;
    protected $courseId;
    protected $currId;
    protected $password;

    public function __construct($id, $studNo, $fname, $lname, $mname, $email, $courseId, $currId, $password)
    {
        $this->id = $id;
        $this->studNo = $studNo;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->mname = $mname;
        $this->email = $email;
        $this->courseId = $courseId;
        $this->currId = $currId;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStudNo()
    {
        return $this->studNo;
    }

    public function getFname()
    {
        return $this->fname;
    }

    public function getLname()
    {
        return $this->lname;
    }

    public function getMname()
    {
        return $this->mname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCourseId()
    {
        return $this->courseId;
    }

    public function getCurrId()
    {
        return $this->currId;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setStudNo($value)
    {
        $this->studNo = $value;
    }

    public function setFname($value)
    {
        $this->fname = $value;
    }

    public function setLname($value)
    {
        $this->lname = $value;
    }

    public function setMname($value)
    {
        $this->mname = $value;
    }

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function setCourseId($value)
    {
        $this->courseId = $value;
    }

    public function setCurrId($value)
    {
        $this->currId = $value;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function getFullName()
    {
        return $this->lname . ", " . $this->fname . " " . ucfirst($this->mname[0]);
    }

    public function getCourse()
    {
        return Cours::getById($this->courseId);
    }

    public function getCurriculum()
    {
        return Curriculum::getById($this->currId);
    }

    public static function getAll()
    {

        $m = Model::getInstance();
        $list = [];
        $r = $m->all('students');
        if ($r) {
            foreach ($r as $v) {
                $data = new Student(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }


    public static function getByStudNo($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('students', 'studNo', $value);
        if ($r) {

            $data = new Student(...$r);
        }
        return $data;
    }
    public static function getById($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('students', 'id', $value);
        if ($r) {

            $data = new Student(...$r);
        }
        return $data;
    }

    public function save()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $query = 'UPDATE students SET studNo=:studNo,fname=:fname,lname=:lname,mname=:mname,email=:email,courseId=:courseId,currId=:currId,password=:password WHERE id=:id';
            $params = array(':id' => $this->id, ':studNo' => $this->studNo, ':fname' => $this->fname, ':lname' => $this->lname, ':mname' => $this->mname, ':email' => $this->email, ':courseId' => $this->courseId, ':currId' => $this->currId, ':password' => $this->password);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO students VALUES (:id,:studNo,:fname,:lname,:mname,:email,:courseId,:currId,:password)';
            $params = array(':id' => $this->id, ':studNo' => $this->studNo, ':fname' => $this->fname, ':lname' => $this->lname, ':mname' => $this->mname, ':email' => $this->email, ':courseId' => $this->courseId, ':currId' => $this->currId, ':password' => $this->password);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $stmt = $m->delete('students', $this->id);
            return $stmt->stmt->rowCount();
        }
    }
}
