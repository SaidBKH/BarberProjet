<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class ContactManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Message_contact";
    protected $tableName = "message_contact";

    public function __construct(){
        parent::connect();
    }
  
    public function getMessagesWithCategory() {
        $sql = "SELECT 
                    name, 
                    email, 
                    message, 
                    dateCreation, 
                    nameCategory 
                FROM 
                    " . $this->tableName . " 
                JOIN 
                    category_contact 
                ON 
                    categoryContact_id 
                ORDER BY 
                    dateCreation DESC";

        return $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }
}


