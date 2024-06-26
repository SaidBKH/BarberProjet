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

    public function ReservationsByClient($clientId) {
        $sql = "SELECT * FROM reservations WHERE client_id = :client_id";
        $params = ['client_id' => $clientId];

        return $this->getMultipleResults(
            DAO::select($sql, ['client_id' => $clientId]), 
            $this->className
        );
    }

    public function AnnulerReservation($id) {
        $sql = "UPDATE " . $this->tableName . " SET client_id = NULL WHERE id_reservation = :id";
        return DAO::update($sql, ['id' => $id]);
    }


    public function findAllGroupedByMonth() {
        $sql = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, COUNT(*) as count
                FROM " . $this->tableName . "
                WHERE client_id IS NOT NULL
                GROUP BY month
                ORDER BY month";
        
        return DAO::select($sql);
    }
    
    public function findByMonthGroupedByDay($month) {
        $sql = "SELECT DISTINCT DATE_FORMAT(date, '%Y-%m-%d') AS day
                FROM " . $this->tableName . "
                WHERE DATE_FORMAT(date, '%Y-%m') = :month AND client_id IS NOT NULL
                ORDER BY day";
        
        return DAO::select($sql, ['month' => $month]);
    }
    
    
    
    public function findByDate($date) {
        $sql = "SELECT reservations.*, client.prenom, client.email, client.telephone, service.name as service_name
                FROM " . $this->tableName . "
                JOIN client ON reservations.client_id = client.id_client
                JOIN service ON reservations.service_id = service.id_service
                WHERE DATE_FORMAT(date, '%Y-%m-%d') = :date AND client_id IS NOT NULL
                ORDER BY heure";
                
        return DAO::select($sql, ['date' => $date]);
    }
    
    public function getAvailableDates() {
        $sql = "SELECT DISTINCT date FROM " . $this->tableName . " ORDER BY date ASC";
        return $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }

    public function annulerByDate($date) {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE date = :date";
        return $this->getMultipleResults(
            DAO::select($sql, ['date' => $date]), 
            $this->className
        );
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->tableName . " WHERE Id_reservation = :id";
        return DAO::delete($sql, ['id' => $id]);
    }
    



    


    }