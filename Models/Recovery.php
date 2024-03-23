<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class Recovery extends Model
{
    protected $id;
    protected $username;
    protected $token;
    protected $date_created;
    protected $isActive;

    public function __construct($id, $username, $token, $date_created, $isActive)
    {
        $this->id = $id;
        $this->username = $username;
        $this->token = $token;
        $this->date_created = $date_created;
        $this->isActive = $isActive;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getDate_created()
    {
        return $this->date_created;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setUsername($value)
    {
        $this->username = $value;
    }

    public function setToken($value)
    {
        $this->token = $value;
    }

    public function setDate_created($value)
    {
        $this->date_created = $value;
    }

    public function setIsActive($value)
    {
        $this->isActive = $value;
    }

    public static function getAll()
    {

        $m = Model::getInstance();
        $list = [];
        $r = $m->all('recoveries');
        if ($r) {
            foreach ($r as $v) {
                $data = new Recovery(...$v);
                $list[] = $data;
            }
        }
        return $list;
    }

    public static function getByToken($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('recoveries', 'token', $value);
        if ($r) {

            $data = new Recovery(...$r);
        }
        return $data;
    }
    public static function getById($value)
    {
        $m = Model::getInstance();
        $data = NULL;
        $r = $m->getOne('recoveries', 'id', $value);
        if ($r) {

            $data = new Recovery(...$r);
        }
        return $data;
    }

    public function save()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $query = 'UPDATE recoveries SET username=:username,token=:token,date_created=:date_created,isActive=:isActive WHERE id=:id';
            $params = array(':id' => $this->id, ':username' => $this->username, ':token' => $this->token, ':date_created' => $this->date_created, ':isActive' => $this->isActive);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        } else {
            $query = 'INSERT INTO recoveries VALUES (:id,:username,:token,:date_created,:isActive)';
            $params = array(':id' => $this->id, ':username' => $this->username, ':token' => $this->token, ':date_created' => $this->date_created, ':isActive' => $this->isActive);
            $result = $m->executeQuery($query, $params);
            return $result->stmt->rowCount();
        }
    }

    public function remove()
    {
        $m = Model::getInstance();
        if ($this->id) {
            $stmt = $m->delete('recoveries', $this->id);
            return $stmt->stmt->rowCount();
        }
    }
}
