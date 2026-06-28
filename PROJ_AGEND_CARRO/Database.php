<?php

require_once __DIR__ . '/Env.php';

// Responsável por criar e fornecer a conexão com o banco de dados
class Database
{
    public $connection; // conexão PDO acessada pelo DAO

    public function __construct()
    {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $db   = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');    

        $dsn = "pgsql:host=$host;port=$port;dbname=$db";

        $this->connection = new PDO($dsn, $user, $pass);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}