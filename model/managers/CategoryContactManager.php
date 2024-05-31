<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class CategoryContactManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Category_contact";
    protected $tableName = "category_contact";

    public function __construct(){
        parent::connect();
    }
  
    public function getAllCategories() {
        return $this->findAll();
    }
    
}

