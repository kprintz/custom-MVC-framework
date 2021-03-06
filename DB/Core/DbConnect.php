<?php

namespace DB\Core;

use \PDO;

class DbConnect
{
    private $server = "localhost";
    private $username = "katherine";
    private $password = "l1lshing";
    private $dbName = "calcdata";

    /**
     * @return PDO
     */
    public function connect()
    {
        $dsn = 'mysql:host=' . $this->server . ';dbname=' . $this->dbName;
        $pdo = new PDO($dsn, $this->username, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
