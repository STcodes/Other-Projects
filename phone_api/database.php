<?php

class Database
{
    private static $dbHost = "localhost";
    private static $dbName = "db_phone";
    private static $dbUsername = "root";
    private static $dbUserpassword = "";
    
    private static $connection = null;
    
    public static function connect()
    {
        if(self::$connection == null)
        {
            try
            {
              self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName , self::$dbUsername, self::$dbUserpassword);
              self::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
              self::$connection->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
              self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$connection;
    }
    
    public static function disconnect()
    {
        self::$connection = null;
    }

}
?>
