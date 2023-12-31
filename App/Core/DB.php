<?php

class DB{
    protected $db;

    public function connect()
    {
        $dsn = "mysql:host=" . HOST . ";dbname=" . DB_NAME;
        $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        try {
            $pdo = new PDO($dsn, USER, PASSWORD, $option);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->db = $pdo;
            return $this->db;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function requirements(...$parms)
    {
        $model  = new $parms[0];
        $method = $parms[1];
        unset($parms[0], $parms[1]);

        return empty($parms) ? $model->$method() : $model->$method($parms[2]);;
    }
}