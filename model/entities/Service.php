<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Service extends Entity{

    private $id;
    private $nom;
    private $prix;



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
     * Get the value of prix
     */ 
    public function getPrix(){
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */ 
    public function setPrix($prix){
        $this->prix = $prix;
        return $this;
    }

      /**
     * Get the value of duree
     */ 
    public function getDuree(){
        return $this->duree;
    }

    /**
     * Set the value of duree
     *
     * @return  self
     */ 
    public function setDuree($duree){
        $this->duree = $duree;
        return $this;
    }

    public function getCategorie(){
        return $this->categorie;
    }
    
    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategorie($categorie){
        $this->categorie = $categorie;
        return $this;
    }


    public function __toString(){
        return $this->name;
    }

    
}