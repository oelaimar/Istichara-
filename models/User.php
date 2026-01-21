<?php
namespace models;

class User{
        private ?int $id = null;
        private string $email;
        private string $password;
        private string $role;

        public function __construct(string $email, string $password, string $role, ?int $id = null)
        {
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
            $this->id = $id;
        }
        public function getId(): ?int {
        return $this->id;
        }
        
        public function getEmail(): string {
            return $this->email;
        }
        
        public function getPassword(): string {
            return $this->password;
        }
        
        public function getRole(): string {
            return $this->role;
        }
        
        public function setId(int $id) {
            $this->id = $id;
        }
        public function setEmail(string $email) {
            $this->email = $email;
        }
        public function setPassword(string $password) {
            $this->password = $password;
        }
        public function setRole(string $role) {
            $this->role = $role;
        }
}

?>
