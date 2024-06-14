<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class News extends Entity{

    private $id;
    private $title;
    private $photo;
    private $text;
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
    public function getTitle(){
        return $this->title;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitle($title){
        $this->title = $title;
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
    public function getText(){
        return $this->text;
    }

    /**
     * Set the value of texte
     *
     * @return  self
     */ 
    public function setText($text){
        $this->text = $text;
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