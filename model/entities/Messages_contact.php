<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Message_contact extends Entity{

    private $id;
    private $nom;
    private $email;
    private $categorie;
    private $message;
    private $date_creation;

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
    
        /**
     * Get the value of name
     */ 
    public function getCategorie(){
        return $this->categorie;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setCategorie($categorie){
        $this->categorie = $categorie;
        return $this;
    }

        /**
     * Get the value of name
     */ 
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
        $date = $this->date_creation->format('d-m H:i');
        return $date;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setDateCreation($date_creation){
        $this->date_creation =new \DateTime($date_creation);
        return $this;
    }
}

