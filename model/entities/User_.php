<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class User_ extends Entity{

    private $id;
    private $nickname;
    private $email;
    private $role;
    private $password;

    private $nbUser;
    private $reCount;


    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of nickName
     */ 
    public function getNickName(){
        return $this->nickname;
    }

    /**
     * Set the value of nickName
     *
     * @return  self
     */ 
    public function setNickName($nickname){
        $this->nickname = $nickname;

        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    /**

     *
     * @return  self
     */ 
    public function setEmail($email){
        $this->email = $email;

        return $this;
    }

    public function getRole(){
        return $this->role;
    }

    /**
     * Set the value of 
     *
     * @return  self
     */ 
    public function setRole($role){
        $this->role = $role;

        return $this;
    }

    public function getPassword(){
        return $this->password;
    }

    /**
     * Set the value of 
     *
     * @return  self
     */ 
    public function setPassword($password){
        $this->password = $password;

        return $this;
    }

    public function __toString() {
        return $this->nickname;
    }

    public function hasRole($role) {
        return $this->role === $role;
    }

    
}
