<?php
declare(strict_types=1);

namespace models;

enum Type:string 
{
    case Signification="signification";
    case Execution="execution";
    case Constats="constats";
}
class Hussier extends Profetionnel{

    public function __construct(string $name, string $phone, float $hourlyRate, int $expYears, string $document,private Type $type, ?int $id = null)
    {
        parent::__construct($name, $phone, $hourlyRate, $expYears, $document, $id);
    }

    public function setType(Type $type): void
    {
        $this->type = $type;
    }


    public function getType(): Type {
        return $this->type;
    }


}