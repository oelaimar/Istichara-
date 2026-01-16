<?php

namespace models;

class Ville{

    public function __construct (   private string $name,
                                    private ?int $id
                                )
    {
    }
    
    public function setName($name):void
    {
        $this->name=$name;
    }

    public function setId($id):void
    {
        $this->id=$id;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getId():?int
    {
        return $this->id;
    }
}