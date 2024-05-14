<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

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
    
    

public function createReservation($data) {
        // Créer une nouvelle instance de Reservation avec les données
        $reservation = new Reservation($data);

        // Insérer la réservation en base de données
        $sql = "INSERT INTO $this->tableName (heure, date, service_id, client_id)
                VALUES (:heure, :date, :service_id, :client_id)";

        $params = [
            'heure' => $reservation->getHeure(),
            'date' => $reservation->getDate(),
            'service_id' => $reservation->getService()->getId(),
            'client_id' => $reservation->getClient()->getId()
        ];

        // Exécuter la requête SQL
        $this->execute($sql, $params);
    }


}
