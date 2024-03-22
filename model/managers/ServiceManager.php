<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class ServiceManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Service";
    protected $tableName = "service";

    public function __construct(){
        parent::connect();
    }
    public function addService($nom) {
        $sql = "INSERT INTO {$this->tableName} (nom) VALUES (:nom)";
        DAO::insert($sql, ['nom' => $nom]);
    }

// récupérer tous les services d'une catégorie spécifique (par son id)
public function findServicesByCategory($id) {

    $sql = "SELECT * 
            FROM ".$this->tableName." t 
            WHERE t.categorie_id = :id";
   
    // la requête renvoie plusieurs enregistrements --> getMultipleResults
    return  $this->getMultipleResults(
        DAO::select($sql, ['id' => $id]), 
        $this->className
    );
}
}