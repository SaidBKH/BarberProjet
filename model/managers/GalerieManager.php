<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class GalerieManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Galerie";
    protected $tableName = "galerie";

    public function __construct(){
        parent::connect();
    }
   


}