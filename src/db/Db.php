<?php

namespace db;

class Db
{
    protected static $instance;

    private function __construct(){}

    public static function conn()
    {
        try
        {
            if(!self::$instance)
            {
                $config = parse_ini_file(PATH_ROOT.DS.'config'.DS.DB_TYPE.'.ini');
                $dsn = "{$config['type']}:host={$config['host']};dbname={$config['base']}";
                $options = array(
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8',
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                );
                self::$instance = new \PDO($dsn, $config['user'], $config['pass'], $options);
            }
            return self::$instance;
        }catch (\PDOException $e)
        {
            echo($e->getMessage());
        }
    }
}

