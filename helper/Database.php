<?php
namespace helper;
use interfaces\DatabaseInterface;
use PDO;

class Database implements DatabaseInterface{
    private static string $host="ep-cold-mountain-ah25jfw1-pooler.c-3.us-east-1.aws.neon.tech";
    private static string $db_name="Istichara";
    private static string $user="neondb_owner";
    private static string $mdp="npg_umhYVWbnKC90";

    private static  $conn=null;

    public static function getConnection()
    {
        if(self::$conn===null){
            $dsn='pgsql:host=' . self::$host . ';dbname=' . self::$db_name . ';port=5432' . ';sslmode=require';
            self::$conn= new PDO($dsn,self::$user,self::$mdp,[
                PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC

            ]);
            
        }
      
        return self::$conn;

        
    }
}

