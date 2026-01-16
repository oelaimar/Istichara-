<?php

namespace models;

abstract class Personne{
    public function __construct(private string $name,
                                private string $email,
                                private string $phone,
                                private ?int $id=null 
                                ) 
    {
    }


    public function setName($name):void
    {
        $this->name=$name;
    }

    public function setEmail($email):void
    {
        $this->email=$email;
    }

    public function setPhone($phone):void
    {
        $this->phone=$phone;
    }

    public function setId($id):void
    {
        $this->id=$id;
    }


    public function getName():string
    {
        return $this->name;
    }


    public function getEmail():string
    {
        return $this->email;
    }


    public function getPhone():string
    {
        return $this->phone;
    }


    public function getId():?int
    {
        return $this->id;
    }
}