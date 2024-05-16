<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Entities\Reservation;
use Model\Entities\Client;

class ReservationManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Reservation";
    protected $tableName = "reservations";

    public function __construct(){
        parent::connect();
    }
   
        // fonction qui liste les disponibilité 

    public function listDispo($id) {
       
        $sql = "SELECT date, heure FROM " . $this->tableName . "
        WHERE service_id = :id AND client_id IS NULL";

        // La requête renvoie plusieurs enregistrements --> getMultipleResults
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }
    

    public function updateReservation($heure, $date, $serviceId, $clientId) {
        $sql = "UPDATE $this->tableName 
                SET client_id = :client_id
               WHERE service_id = :service_id
               AND date = :date
               AND heure = :heure";
    
        return DAO::update($sql, [
            'heure' => $heure,
            'date' => $date,
            'service_id' => $serviceId,
            'client_id' => $clientId
        ]);
    }


public function ReservationsByClient($id) {
    $sql = "SELECT * FROM " . $this->tableName . "
            WHERE client_id = :id";

    return $this->getMultipleResults(
        DAO::select($sql, ['client_id' => $id]),
        $this->className
    );
}


}
   