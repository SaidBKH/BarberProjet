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
        $sql = "SELECT reservations.*, client.prenom, client.email, client.telephone, service.nom as service_nom
                FROM " . $this->tableName . "
                JOIN client ON reservations.client_id = client.id_client
                JOIN service ON reservations.service_id = service.id_service
                WHERE DATE_FORMAT(date, '%Y-%m-%d') = :date AND client_id IS NOT NULL
                ORDER BY heure";
                
        return DAO::select($sql, ['date' => $date]);
    }
    



    public function creerReservation() {
        $categorieManager = new CategorieManager();
        $serviceManager = new ServiceManager();
        $reservationManager = new ReservationManager();
        
        // Récupérer la liste de toutes les catégories et de tous les services
        $categories = $categorieManager->findAll();
        $services = $serviceManager->findAll();

        // Générer les plages horaires pour aujourd'hui
        $date = date('Y-m-d');
        $timeSlots = $reservationManager->generateTimeSlots($date);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement du formulaire de réservation ici
            // ...
        }

        return [
            "view" => VIEW_DIR."admin/creerReservation.php",
            "meta_description" => "Ajouter une réservation",
            "data" => [
                "categories" => $categories,
                "services" => $services,
                "timeSlots" => $timeSlots
            ]
        ];
    }


    public function generateTimeSlots($date) {
        $timeSlots = array();
        $startTime = strtotime('09:00');
        $endTime = strtotime('19:00');

        // Parcourir les heures de 9h à 19h avec un intervalle de 30 minutes
        for ($time = $startTime; $time < $endTime; $time += 1800) {
            // Construire la plage horaire au format heure:minute
            $timeSlots[] = date('H:i', $time);
        }

        return $timeSlots;
    }
    

}
