<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Entities\Reservation;
use Model\Entities\Client;

class ReservationManager extends Manager {

    // Nom de la classe d'entité associée
    protected $className = "Model\Entities\Reservation";
    
    // Nom de la table correspondante en base de données
    protected $tableName = "reservations";

    // Constructeur de la classe
    public function __construct() {
        parent::connect(); // Appelle le constructeur de la classe parente pour établir la connexion à la base de données
    }
   
    // Méthode pour lister les disponibilités pour un service spécifique (non réservé)
    public function listDispo($id) {
        $sql = "SELECT date, heure FROM " . $this->tableName . "
                WHERE service_id = :id AND client_id IS NULL";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), // Exécution de la requête SQL
            $this->className // Classe d'entité associée pour la conversion du résultat
        );
    }

    // Méthode pour mettre à jour une réservation en associant un client
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
        ]); // Exécution de la requête de mise à jour
    }

    // Méthode pour trouver toutes les réservations d'un client spécifique
    public function ReservationsByClient($clientId) {
        $sql = "SELECT * FROM reservations WHERE client_id = :client_id";
        $params = ['client_id' => $clientId];

        return $this->getMultipleResults(
            DAO::select($sql, ['client_id' => $clientId]), // Exécution de la requête SQL
            $this->className // Classe d'entité associée pour la conversion du résultat
        );
    }

    // Méthode pour annuler une réservation en la déliant d'un client
    public function AnnulerReservation($id) {
        $sql = "UPDATE " . $this->tableName . " SET client_id = NULL WHERE id_reservation = :id";
        return DAO::update($sql, ['id' => $id]); // Exécution de la requête de mise à jour
    }

    // Méthode pour trouver toutes les réservations groupées par mois
    public function findAllGroupedByMonth() {
        $sql = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, COUNT(*) as count
                FROM " . $this->tableName . "
                WHERE client_id IS NOT NULL
                GROUP BY month
                ORDER BY month";
        
        return DAO::select($sql); // Exécution de la requête SQL
    }
    
    // Méthode pour trouver les jours disponibles d'un mois spécifique
    public function findByMonthGroupedByDay($month) {
        $sql = "SELECT DISTINCT DATE_FORMAT(date, '%Y-%m-%d') AS day
                FROM " . $this->tableName . "
                WHERE DATE_FORMAT(date, '%Y-%m') = :month AND client_id IS NOT NULL
                ORDER BY day";
        
        return DAO::select($sql, ['month' => $month]); // Exécution de la requête SQL
    }

    // Méthode pour trouver les réservations pour une date spécifique
    public function findByDate($date) {
        $sql = "SELECT reservations.*, client.prenom, client.email, client.telephone, service.name as service_name
                FROM " . $this->tableName . "
                JOIN client ON reservations.client_id = client.id_client
                JOIN service ON reservations.service_id = service.id_service
                WHERE DATE_FORMAT(date, '%Y-%m-%d') = :date AND client_id IS NOT NULL
                ORDER BY heure";
                
        return DAO::select($sql, ['date' => $date]); // Exécution de la requête SQL
    }

    // Méthode pour obtenir toutes les dates disponibles
    public function getAvailableDates() {
        $sql = "SELECT DISTINCT date FROM " . $this->tableName . " ORDER BY date ASC";
        return $this->getMultipleResults(
            DAO::select($sql), // Exécution de la requête SQL
            $this->className // Classe d'entité associée pour la conversion du résultat
        );
    }

    // Méthode pour annuler toutes les réservations d'une date spécifique
    public function annulerByDate($date) {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE date = :date";
        return $this->getMultipleResults(
            DAO::select($sql, ['date' => $date]), // Exécution de la requête SQL
            $this->className // Classe d'entité associée pour la conversion du résultat
        );
    }

    // Méthode pour supprimer une réservation spécifique
    public function delete($id) {
        $sql = "DELETE FROM " . $this->tableName . " WHERE Id_reservation = :id";
        return DAO::delete($sql, ['id' => $id]); // Exécution de la requête de suppression
    }
}
