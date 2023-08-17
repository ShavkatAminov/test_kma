<?php

namespace Shavkat\Kma\db;


class WebContent extends Connection
{
    private $TABLE_NAME = 'web_content';

    public function createTable()
    {
        $this->conn->query("CREATE TABLE IF NOT EXISTS `$this->TABLE_NAME`(id INT(11) AUTO_INCREMENT, size_content INT(11) NOT NULL, created_at INT NOT NULL, PRIMARY KEY(id));");
    }

    public function __construct()
    {
        parent::__construct();
        if ($this->conn) {
            $this->createTable();
        }
        else {
            echo 'no connection';
        }
    }

    public function add($size)
    {
        if($this->conn) {
            $statement = $this->conn->prepare("INSERT INTO " . $this->TABLE_NAME . "(size_content, created_at) VALUES(:size_content, :created_at)");
            $statement->execute([
                ':size_content' => $size,
                ':created_at' => time(),
            ]);
        }
    }
}
