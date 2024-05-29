<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Messages_contact extends Entity{

    private $id;
    private $nom;
    private $email;
    private $message;
    private $dateCreation;
    private $categorieContact;


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
    public function getNom(){
        return $this->nom;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setNom($nom){
        $this->nom = $nom;
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
    public function getCategorieContact(){
        return $this->categorieContact;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setCategorieContact($categorieContact){
        $this->categorieContact = $categorieContact;
        return $this;
    }
}

