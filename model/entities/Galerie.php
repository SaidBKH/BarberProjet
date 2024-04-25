<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Galerie extends Entity{

    private $id;
    private $title;
    private $description;
    private $imageUrl;
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
    public function getTitre(){
        return $this->title;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setTitre($title){
        $this->title = $title;
        return $this;
    }

 

      /**
     * Get the value of name
     */ 
    public function getImageUrl(){
        return $this->imageUrl;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setImageUrl($imageUrl){
        $this->imageUrl = $imageUrl;
        return $this;
    }

      /**
     * Get the value of name
     */ 
    public function getDateCreation(){
        return $this->date_creation;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setDateCreation($date_creation){
        $this->date_creation = $date_creation;
        return $this;
    }
}