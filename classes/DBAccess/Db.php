<?php
namespace Was;

class Db extends \PDO
{
    private static $instance;


    public static function getInstance()
    {
        if (!self::$instance) {
            try {
                $host = Config::DB_HOST;
                $name = Config::DB_NAME;
                $charset = Config::DB_CHARSET;
                $user = Config::DB_USER;
                $password = Config::DB_PASS;

                $db = new \PDO('mysql:host=' . $host . ';dbname=' . $name . ';charset=utf8', $user, $password);
            } catch (\PDOException $e) {
                die('エラーメッセージ：'.$e->getMessage());
            }

            self::$instance = $db;
        }

        return self::$instance;
    }
}
