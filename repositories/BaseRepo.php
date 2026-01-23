<?php
namespace repositories;
use helper\Database;
use PDO;

abstract class BaseRepo
{
    protected string $table;
    protected PDO $conn;

    public function initCrud()
    {
        $this->conn=Database::getConnection();
    }

    public function __construct()
    {
        $this->initCrud();
    }
    // =====CREATE=====
    public function create(array $data):bool
    {
        $columns = implode(",",array_keys($data));
        $placeholders = ":" . implode(",:",array_keys($data));

        $stmt=$this->conn->prepare("INSERT INTO {$this->table}($columns) VALUES($placeholders)");
        return $stmt->execute($data);
    }


    // =====AFFICHAGE=====
    public function affichage():array
    {
       $stmt=$this->conn->prepare("SELECT * FROM {$this->table}");
       $stmt->execute();
       $result=$stmt->fetchALL();
       return $result;
    }


    // ======DELETE=====
    public function delete(int $id):bool
    {
        $stmt=$this->conn->prepare("DELETE FROM {$this->table} WHERE id=:id");
        $result=$stmt->execute(["id"=>$id]);
        return $result;
    }


    // ======UPDATE=====
    public function update(int $id, array $data):bool
    {
        $fields="";
        
        foreach($data as $key=>$value){
            $fields.= "$key=:$key,";
            }
        $fields=rtrim($fields,",");
        $data["id"]=$id;

        
        $stmt=$this->conn->prepare("UPDATE {$this->table} SET $fields WHERE id=:id");
        $result=$stmt->execute($data);
        return $result;
    }


}
