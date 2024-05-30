<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class newsManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\News";
    protected $tableName = "news";

    public function __construct(){
        parent::connect();
    }
   


}