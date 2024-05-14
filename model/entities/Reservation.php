<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Reservation extends Entity{

    private $id;
    private $heure;
    private $date;
    private $service;
    private $client;





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
     * Get the value of heure
     */ 
    public function getHeure(){
        // Convertir l'heure en objet DateTime
        $dateTime = new \DateTime($this->heure); // Utilisation de \DateTime sans namespace
        
        // Formater l'heure en utilisant le format spécifié
        return $dateTime->format('H:i');
    }

    /**
     * Set the value of heure
     *
     * @return  self
     */ 
    public function setHeure($heure){
        $this->heure = $heure;
        return $this;
    }

  /**
     * Get the value of date
     */ 
    public function getDate() {
        // Convertir la date en objet DateTime
        $dateTime = new \DateTime($this->date); 
        
        return $dateTime->format('j/m/Y');
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

      /**
     * Get the value of service
     */ 
   

    public function getService(){
        return $this->service;
    }
    
    /**
     * Set the value of service
     *
     * @return  self
     */ 
    public function setService($service){
        $this->service = $service;
        return $this;
    }

    public function getClient(){
        return $this->client;
    }
    
    /**
     * Set the value of service
     *
     * @return  self
     */ 
    public function setClient($client){
        $this->client = $client;
        return $this;
    }


    
}