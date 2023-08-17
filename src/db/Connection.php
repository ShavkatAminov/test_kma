<?php

namespace Shavkat\Kma\db;

use PDO;
use PDOException;

class Connection
{
    protected $conn = null;
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=chat_db;port=4306", 'root', '');
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {}
    }

    public function getResultSql($sql) {
        $rows = [];
        if($this->conn) {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $rows;
    }
}
