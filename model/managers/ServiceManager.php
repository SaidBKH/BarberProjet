<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class ServiceManager extends Manager {

    // Nom de la classe d'entité associée
    protected $className = "Model\Entities\Service";
    
    // Nom de la table correspondante en base de données
    protected $tableName = "service";

    // Constructeur de la classe
    public function __construct() {
        parent::connect(); // Appelle le constructeur de la classe parente pour établir la connexion à la base de données
    }
    
    // Méthode pour ajouter un nouveau service
    public function addService($name) {
        $sql = "INSERT INTO {$this->tableName} (name) VALUES (:name)";
        DAO::insert($sql, ['name' => $name]); // Exécution de la requête d'insertion
    }

    // Méthode pour récupérer tous les services d'une catégorie spécifique
    public function findServicesByCategory($id) {
        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.category_id = :id";
   
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), // Exécution de la requête SQL
            $this->className // Classe d'entité associée pour la conversion du résultat
        );
    }
}
