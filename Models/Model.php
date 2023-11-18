<?php

namespace Makkari\Models;


class Model
{
    private static $instance; // Singleton instance
    private $conn;

    private function __construct()
    {
        $this->connect();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Model();
        }
        return self::$instance;
    }

    private function connect()
    {
        if (!$this->conn) {
            try {
                $this->conn = new \PDO("mysql:host=" . SERVER . ";dbname=" . DB_NAME . "", USERNAME, PASSWORD);
                $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                throw new \PDOException("Database connection error: " . $e->getMessage());
            }
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    protected function executeQuery($query, $params = array())
    {
        date_default_timezone_set("Asia/Manila");
        date_default_timezone_get();
        try {
            $stmt  = $this->conn->prepare($query);
            $stmt->execute($params);

            $lastInsertId = $this->conn->lastInsertId();

            $result = new \stdClass();
            $result->stmt = $stmt;
            $result->lastInsertId = $lastInsertId;

            return $result;
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    protected function executeMultiQuery($query, $params = array())
    {
        try {
            $stmt  = $this->conn->prepare($query);
            $stmt->execute($params);

            do {
                if ($result = $stmt->fetchAll(\PDO::FETCH_ASSOC)) {
                    return $result;
                }
            } while ($stmt->nextRowset());

            // return $stmt;
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getOne($table, $field, $id)
    {
        try {
            $stmt = $this->executeQuery("SELECT * FROM $table WHERE $field=:id", array(':id' => $id));

            return $stmt->stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }
    public function all($table)
    {
        $stmt = $this->executeQuery("SELECT * FROM $table");

        return $stmt->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function delete($table, $id)
    {
        $stmt = $this->executeQuery("DELETE FROM $table WHERE id=:id", array(':id' => $id));
        return $stmt;
    }

    public function beginTransaction()
    {
        try {
            $this->conn->beginTransaction();
        } catch (\PDOException $e) {
            echo "Error starting transaction: " . $e->getMessage();
            return false;
        }
        return true;
    }
    public function commitTransaction()
    {
        try {
            $this->conn->commit();
        } catch (\PDOException $e) {
            echo "Error committing transaction: " . $e->getMessage();
            return false;
        }
        return true;
    }

    public function rollbackTransaction()
    {
        try {
            $this->conn->rollBack();
        } catch (\PDOException $e) {
            echo "Error rolling back transaction: " . $e->getMessage();
            return false;
        }
        return true;
    }
}
