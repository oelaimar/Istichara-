<?php
declare(strict_types=1);

namespace models;

enum Type:string 
{
    case Signification="Signification";
    case Execution="Eécution";
    case Constats="Constats";
}
class Hussier extends Profetionnel{

    public function __construct(string $name, string $phone, float $hourlyRate, int $expYears, string $document,int $numviwers,private Type $type ,?int $id = null)
    {
        parent::__construct($name, $phone, $hourlyRate, $expYears, $document,$numviwers,$id);
    }

    public function setType(Type $type): void
    {
        $this->type = $type;
    }


    public function getType(): Type {
        return $this->type;
    }


}