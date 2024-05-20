<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Client extends Entity{

    private $id;
    private $email;
    private $telephone;
    private $prenom;
    private $password;
    private $creationDate;
    private $role;

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
     * Get the value of email
     */ 
    public function getEmail(){
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email){
        $this->email = $email;

        return $this;
    }

        /**
     * Get the value of telephone
     */ 
    public function getTelephone(){
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @return  self
     */ 
    public function setTelephone($telephone){
        $this->telephone = $telephone;

        return $this;
    }

        /**
     * Get the value of prenom
     */ 
    public function getPrenom(){
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom){
        $this->prenom = $prenom;

        return $this;
    }

            /**
     * Get the value of password
     */ 
    public function getPassword(){
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password){
        $this->password = $password;

        return $this;
    }

        /**
     * Get the value of creationDate
     */ 
    public function getCreationDate(){
        return $this->creationDate;
    }

    /**
     * Set the value of creationDate
     *
     * @return  self
     */ 
    public function setCreationDate($creationDate){
        $this->creationDate = $creationDate;

        return $this;
    }
    
            /**
     * Get the value of role
     */ 
    public function getRole(){
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role){
        $this->role = $role;

        return $this;
    }

    public function __toString()
    {
        return $this;
    }

    public function hasRole($role){
        return $this->getRole() === $role;
    }

}
