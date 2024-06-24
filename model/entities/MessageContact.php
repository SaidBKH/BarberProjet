<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class MessageContact extends Entity{

    private $id;
    private $name;
    private $email;
    private $message;
    private $dateCreation;
    private $categoryContact;


    // chaque entité aura le même constructeur grâce à la méthode hydrate (issue de App\Entity)
    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName(){
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name){
        $this->name = $name;
        return $this;
    }


        /**
     * Get the value of name
     */ 
    public function getEmail(){
        return $this->email;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }
    
  
    public function getMessage(){
        return $this->message;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setMessage($message){
        $this->message = $message;
        return $this;
    }

        /**
     * Get the value of name
     */ 
    public function getDateCreation(){
        $date = $this->dateCreation->format('d-m H:i');
        return $date;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setDateCreation($dateCreation){
        $this->dateCreation =new \DateTime($dateCreation);
        return $this;
    }
 

            /**
     * Get the value of name
     */ 
    public function getCategoryContact(){
        return $this->categoryContact;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setCategoryContact($categoryContact){
        $this->categoryContact = $categoryContact;
        return $this;
    }

  


}

