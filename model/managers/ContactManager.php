<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class ContactManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Messages_contact";
    protected $tableName = "messages_contact";

    public function __construct(){
        parent::connect();
    }
  
}