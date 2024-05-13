<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class ReservationManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Reservations";
    protected $tableName = "reservations";

    public function __construct(){
        parent::connect();
    }

    public function listDisponibilite($id)
    {
        $sql = "SELECT date, heure  
                FROM " . $this->tableName . " 
                WHERE service_id = :id AND client_id IS NULL"; /

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }
}
