<?php
declare(strict_types=1);

Class UsersView extends Users{
    public function showUser(string $username,string $password){
        $result = $this->getUser($username,$password);
        return $result;
    }
    
    public function showUserId(string $username){
        $result = $this->getUserId($username);
        return $result;
    }
    public function showLastInsertedId(){
        $result = $this->getLastInsertedId();
        return $result;
    }
}
