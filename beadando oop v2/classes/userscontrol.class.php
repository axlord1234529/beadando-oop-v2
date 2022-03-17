<?php
declare(strict_types=1);

Class UsersControl extends Users{
    public function createUser (string $username,string $password,string $familyname ,string $surname){
        $result = $this->setUser($username,$password,$familyname ,$surname);
        return $result;
    }
}