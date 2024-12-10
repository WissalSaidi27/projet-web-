<?php

class Config
{
    private static $pdo = null;

    public static function getConnexion()
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    'mysql:host=127.0.0.1;dbname=my_database', // Replace 'my_database' with your actual database name
                    'root', // Replace 'root' with your DB username if different
                    '', // Replace '' with your DB password if any
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}

Config::getConnexion();
