<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Service extends Entity{

    private $id;
    private $name;
    private $price;
    private $duration;
    private $category;




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
     
     * @return  self
     */ 
    public function setName($name){
        $this->name = $name;
        return $this;
    }

  /**
     * Get the value of price
     */ 
    public function getPrice(){
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price){
        $this->price = $price;
        return $this;
    }

      /**
     * Get the value of duration
     */ 
    public function getDuration(){
        $duration = $this->duration->format('i');
        return $duration;
    }

    /**
     * Set the value of duration
     *
     * @return  self
     */ 
    public function setDuration($duration){
        $this->duration = new \DateTime($duration);
        return $this;
    }

    public function getCategory(){
        return $this->category;
    }
    
    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category){
        $this->category = $category;
        return $this;
    }



    
}