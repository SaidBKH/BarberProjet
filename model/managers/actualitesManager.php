<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class ActualitesManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Actualites";
    protected $tableName = "actualites";

    public function __construct(){
        parent::connect();
    }
   


}