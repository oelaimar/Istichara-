<?php
namespace helper;
use interfaces\DatabaseInterface;
use PDO;

class Database implements DatabaseInterface{
    private static string $host="localhost";
    private static string $db_name="istichara2";
    private static string $user="root";
    private static string $mdp="";
    private static int $port=3306;

    private static  $conn=null;

    public static function getConnection()
    {
        if(self::$conn===null){
            $dsn='mysql:host=' . self::$host . ';dbname=' . self::$db_name . ';port=' . self::$port . ';charset=utf8';
            self::$conn= new PDO($dsn,self::$user,self::$mdp,[
                PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC

            ]);
            
        }
      
        return self::$conn;

        
    }
}

