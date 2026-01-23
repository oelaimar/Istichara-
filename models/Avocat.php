<?php
declare(strict_types=1);

namespace models;

enum Specialisation:string 
{
    case DroitPenal="Droit pénal";
    case Civile="Civil";
    case Famille="Famille";
    case Affaires="Affaires";
}
class Avocat extends Profetionnel{
    public function __construct(string $name, string $phone, float $hourlyRate, int $expYears, string $document,int $numviwers,private Specialisation $specialisation,private bool $consultationOnline, ?int $id = null)
    {
        parent::__construct($name, $phone, $hourlyRate, $expYears, $document,$numviwers ,$id);
    }

    

    public function setSpecialisation(Specialisation $specialisation): void
    {
        $this->specialisation = $specialisation;
    }

    public function setConsultationOnline(bool $consultationOnline): void
    {
        $this->consultationOnline = $consultationOnline;
    }

    

    public function getSpecialisation(): Specialisation {
        return $this->specialisation;
    }

    public function isConsultationOnline(): bool {
        return $this->consultationOnline;
    }

}