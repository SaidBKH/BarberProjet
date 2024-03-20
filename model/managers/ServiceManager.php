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



}