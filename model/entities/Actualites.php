<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Actualites extends Entity{

    private $id;
    private $titre;
    private $photo;
    private $texte;
    private $date;


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
     * Get the value of titre
     */ 
    public function getTitre(){
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre){
        $this->titre = $titre;
        return $this;
    }

     /**
     * Get the value of photo
     */ 
    public function getPhoto(){
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @return  self
     */ 
    public function setPhoto($photo){
        $this->photo = $photo;
        return $this;
    }
    
         /**
     * Get the value of texte
     */ 
    public function getTexte(){
        return $this->texte;
    }

    /**
     * Set the value of texte
     *
     * @return  self
     */ 
    public function setTexte($texte){
        $this->texte = $texte;
        return $this;
    }

      /**
     * Get the value of date
     */ 
    public function getDate(){
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date){
        $this->date = $date;
        return $this;
    }
}