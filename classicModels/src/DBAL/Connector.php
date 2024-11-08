<?php

namespace Ferdydurke\ClassicModels\DBAL;

class Connector
{
    const DSN = "mysql:dbname=classicmodels;host=127.0.0.1:8889";

    public \PDO $dbh;

    public function __construct()
    {
       $this->dbh = new \PDO(self::DSN, 'root', 'root');
    }
}
