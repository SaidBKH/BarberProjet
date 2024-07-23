<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class ContactManager extends Manager {

    // Nom de la classe d'entité associée
    protected $className = "Model\Entities\MessageContact";
    
    // Nom de la table correspondante en base de données
    protected $tableName = "messageContact";

    // Constructeur de la classe
    public function __construct() {
        parent::connect(); // Appelle le constructeur de la classe parente pour établir la connexion à la base de données
    }
  
    // Méthode pour obtenir tous les messages avec leur catégorie, triés par date de création décroissante
    public function getMessagesWithCategory() {
        $sql = "SELECT id_messageContact, name, email, message, dateCreation, categoryContact_id 
                FROM 
                    " . $this->tableName . " 
                ORDER BY 
                    dateCreation DESC";
                    
        return $this->getMultipleResults(
            DAO::select($sql), // Exécution de la requête SQL
            $this->className // Classe d'entité associée pour la conversion du résultat
        );
    }
}

