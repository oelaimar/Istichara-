<?php

namespace models;

class Demande extends Profetionnel{
    private ?string $specialization = null;
    private ?bool $consultationOnline = null;
    private ?string $type = null;
    private string $email;
    private string $password;
    private int $user_id;
    private int $city_id;
    private string $status;
    public function __construct(string $name, string  $email, string $password, string $phone, float $hourlyRate, int $expYears, string $document,string $status, int $city_id,?string $specialization = null, ?bool $consultationOnline = null, ?string $type = null,  ?int $id = null)
    {
        parent::__construct($name, $phone, $hourlyRate, $expYears, $document, $id);
        $this->specialization = $specialization;
        $this->consultationOnline = $consultationOnline;
        $this->type = $type;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
        $this->city_id = $city_id;
    }
    public function getCityId(){
        return $this->city_id;
    }
    public function getUserId(){
        return $this->user_id;
    }
    public function setCityId(int $city_id){
        $this->city_id = $city_id;
    }
    public function setUserId(int $user_id){
        $this->user_id = $user_id;
    }
    public function setSpecialization($specialization)
    {
        $this->specialization = $specialization;
    }

    public function setConsultationOnline(bool $consultationOnline)
    {
        $this->consultationOnline = $consultationOnline;
    }
    public function getspecialization(){
        return $this->specialization;
    }

    public function isConsultationOnline() {
        return $this->consultationOnline ? 1 : 0;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
    public function getType(){
        return $this->type;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}

?>