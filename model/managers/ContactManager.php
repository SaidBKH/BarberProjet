<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class ContactManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\MessageContact";
    protected $tableName = "messageContact";

    public function __construct(){
        parent::connect();
    }
  
    public function getMessagesWithCategory() {
        $sql = "SELECT id_messageContact, name, email, message, dateCreation, categoryContact_id 
                FROM 
                    " . $this->tableName . " 
                ORDER BY 
                    dateCreation DESC";
                    
        return $this->getMultipleResults(
            DAO::select($sql), 
            
            $this->className
        );
    }
}


