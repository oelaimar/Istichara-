<?php
namespace models;

class Profetionnel extends Personne{

    public function __construct(string $name,
                            string $phone,
                            private float $hourlyRate,
                            private int $expYears,
                            private string $document,
                            private int   $numviwers,
                            ?int $id = null)
    {
        parent::__construct($name, $phone, $id);
    }

    public function setExpYears(int $exp_years):void
    {
        $this->expYears=$exp_years;
    }

    public function setHourlyRate(float $hourly_rate):void
    {
        $this->hourlyRate=$hourly_rate;
    }

    public function setDocument(float $document):void
    {
        $this->document=$document;
    }
        public function setNumviwers($numviwers) : void {
        $this->numviwers=$numviwers;
        
    }

    public function getExpYears(): int {
        return $this->expYears;
    }

    public function getHourlyRate(): float {
        return $this->hourlyRate;
    }

    public function getDocument(): string {
        return $this->document;
    }
        public function getNumviwers() : int {
        return $this->numviwers;
    }
}