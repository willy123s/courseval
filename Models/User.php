<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class User extends Model
{
    protected $id;
    protected $empno;
    protected $fname;
    protected $lname;
    protected $mname;
    protected $email;
    protected $password;
    protected $courseId;
    protected $userType;

    public function __construct($id, $empno, $fname, $lname, $mname, $email, $password, $courseId, $userType)
    {
        $this->id = $id;
        $this->empno = $empno;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->mname = $mname;
        $this->email = $email;
        $this->password = $password;
        $this->courseId = $courseId;
        $this->userType = $userType;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmpno()
    {
        return $this->empno;
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

    public function getPassword()
    {
        return $this->password;
    }

    public function getCourseId()
    {
        return $this->courseId;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setEmpno($value)
    {
        $this->empno = $value;
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

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function setCourseId($value)
    {
        $this->courseId = $value;
    }

    public function setUserType($value)
    {
        $this->userType = $value;
    }
    public function getFullname()
    {
        return $this->lname . ", " . $this->fname . " " . ucfirst($this->mname[0]);
    }
    public function getCourse()
    {
        return Cours::getById($this->courseId);
    }
    public static function getAll()
    {
        $m = Model::getInstance();
        $list = [];
        $r = $m->all('users');
        if ($r) {
            foreach ($r as $v) {
                $data = new User(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getByEmpNo($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('users', 'empno', $value);
        if ($r) {

            $data = new User(...$r);
        }
        return $data;
    }
    public static function getById($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('users', 'id', $value);
        if ($r) {

            $data = new User(...$r);
        }
        return $data;
    }

    public function save()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $query = 'UPDATE users SET empno=:empno,fname=:fname,lname=:lname,mname=:mname,email=:email,password=:password,courseId=:courseId,userType=:userType WHERE id=:id';
            $params = array(':id' => $this->id, ':empno' => $this->empno, ':fname' => $this->fname, ':lname' => $this->lname, ':mname' => $this->mname, ':email' => $this->email, ':password' => $this->password, ':courseId' => $this->courseId, ':userType' => $this->userType);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO users VALUES (:id,:empno,:fname,:lname,:mname,:email,:password,:courseId,:userType)';
            $params = array(':id' => $this->id, ':empno' => $this->empno, ':fname' => $this->fname, ':lname' => $this->lname, ':mname' => $this->mname, ':email' => $this->email, ':password' => $this->password, ':courseId' => $this->courseId, ':userType' => $this->userType);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $stmt = $m->delete('users', $this->id);
            return $stmt->stmt->rowCount();
        }
    }
}
