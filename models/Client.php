<?php
namespace models;
use models\Personne;

class Client extends Personne{
    private int $city_id;
    private int $user_id;
    public function __construct(int $user_id, string $name, string $email, string $phone, int $city_id, ?int $id = null)
    {
        parent::__construct($name, $email, $phone, $id);
        $this->city_id = $city_id;
        $this->user_id = $user_id;
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
}



?>
