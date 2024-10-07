<?php

namespace Makkari\Models;

use Makkari\Models\Model;
use PDO;

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

    public function __construct($id, $studNo, $fname, $lname, $mname = null, $email, $courseId, $currId, $password)
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
        return $this->lname . ", " . $this->fname . ($this->mname ? " " . ucfirst($this->mname[0]) . "." : "");
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
        $currentCurrId = null;
    
        if ($this->id) {
            // Fetch the current currId from the database
            $currentCurrIdQuery = 'SELECT currId FROM students WHERE id=:id';
            $currentParams = array(':id' => $this->id);
            $currentCurrIdResult = $m->executeQuery($currentCurrIdQuery, $currentParams);
            $currentCurrId = $currentCurrIdResult->stmt->fetchColumn();
    
            // Check if currId has changed
            if ($this->currId !== $currentCurrId) {
                // Fetch all subjects for the student
                $subjectQuery = 'SELECT currDetailsId FROM grades WHERE studId=:studId';
                $subjectParams = array(':studId' => $this->id);
                $subjectResults = $m->executeQuery($subjectQuery, $subjectParams);
    
                // Loop through each subject and update currDetailsId
                while ($subject = $subjectResults->stmt->fetch(PDO::FETCH_ASSOC)) {
                    $currDetailsId = $subject['currDetailsId'];
    
                    // Find new currDetailsId based on the new currId and existing currDetailsId
                    $newCurrDetailsIdQuery = 'SELECT id FROM curriculumdetails WHERE currId=:newCurrId AND subId=(SELECT subId FROM curriculumdetails WHERE id=:currDetailsId)';
                    $newCurrDetailsIdParams = array(':newCurrId' => $this->currId, ':currDetailsId' => $currDetailsId);
                    $newCurrDetailsIdResult = $m->executeQuery($newCurrDetailsIdQuery, $newCurrDetailsIdParams);
                    $newCurrDetailsId = $newCurrDetailsIdResult->stmt->fetchColumn();
    
                    // Update the grade record with the new currDetailsId
                    if ($newCurrDetailsId) {
                        $updateGradesQuery = 'UPDATE grades SET currDetailsId=:newCurrDetailsId WHERE studId=:studId AND currDetailsId=:currDetailsId';
                        $updateGradesParams = array(
                            ':newCurrDetailsId' => $newCurrDetailsId,
                            ':studId' => $this->id,
                            ':currDetailsId' => $currDetailsId
                        );
                        $m->executeQuery($updateGradesQuery, $updateGradesParams);
                    }
                }
            }
    
            // Update student information
            $query = 'UPDATE students SET studNo=:studNo, fname=:fname, lname=:lname, mname=:mname, email=:email, courseId=:courseId, currId=:currId, password=:password WHERE id=:id';
            $params = array(
                ':id' => $this->id,
                ':studNo' => $this->studNo,
                ':fname' => $this->fname,
                ':lname' => $this->lname,
                ':mname' => $this->mname,
                ':email' => $this->email,
                ':courseId' => $this->courseId,
                ':currId' => $this->currId,
                ':password' => $this->password
            );
    
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            // Insert new student record
            $query = 'INSERT INTO students (id, studNo, fname, lname, mname, email, courseId, currId, password) VALUES (:id, :studNo, :fname, :lname, :mname, :email, :courseId, :currId, :password)';
            $params = array(
                ':id' => $this->id,
                ':studNo' => $this->studNo,
                ':fname' => $this->fname,
                ':lname' => $this->lname,
                ':mname' => $this->mname,
                ':email' => $this->email,
                ':courseId' => $this->courseId,
                ':currId' => $this->currId,
                ':password' => $this->password
            );
    
            // Adjust insert query if mname is null
            if ($this->mname === null) {
                unset($params[':mname']);
                $query = 'INSERT INTO students (id, studNo, fname, lname, email, courseId, currId, password) VALUES (:id, :studNo, :fname, :lname, :email, :courseId, :currId, :password)';
            }
    
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
