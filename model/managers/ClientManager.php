<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class ClientManager extends Manager {

    // Nom de la classe d'entité associée
    protected $className = "Model\Entities\Client";
    
    // Nom de la table correspondante en base de données
    protected $tableName = "client";

    // Constructeur de la classe
    public function __construct() {
        parent::connect(); // Appelle le constructeur de la classe parente pour établir la connexion à la base de données
    }
  
    // Méthode pour vérifier si un email existe déjà dans la base de données
    public function emailExist($email) {
        $sql = "SELECT email FROM client WHERE email = :email LIMIT 1"; // Requête SQL pour sélectionner un email
        $donnee = ['email' => $email]; // Données de la requête
        $result = DAO::select($sql, $donnee); // Exécution de la requête

        return !empty($result); // Retourne true si l'email existe, false sinon
    }

    // Méthode pour trouver un client par son email
    public function findByEmail($email) {
        $sql = "SELECT * FROM ".$this->tableName." WHERE email = :email"; // Requête SQL pour sélectionner toutes les colonnes pour un email spécifique
        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false), // Exécution de la requête
            $this->className // Classe d'entité associée pour la conversion du résultat
        );
    }

    // Méthode pour mettre à jour le mot de passe d'un client
    public function updatePassword($clientId, $newPasswordHash) {
        $sql = "UPDATE client SET password = :password WHERE id = :id"; // Requête SQL pour mettre à jour le mot de passe
        $params = ['password' => $newPasswordHash, 'id' => $clientId]; // Données de la requête
        return DAO::update($sql, $params); // Exécution de la requête de mise à jour
    }

    // Méthode pour mettre à jour les informations du profil d'un client
    public function updateProfile($id, $data) {
        $fields = array_keys($data); // Récupère les noms des colonnes à mettre à jour
        $values = array_values($data); // Récupère les valeurs des colonnes à mettre à jour

        // Crée la clause SET de la requête SQL
        $setClause = "";
        foreach ($fields as $field) {
            $setClause .= "$field = ?, "; // Ajoute chaque colonne à mettre à jour
        }
        $setClause = rtrim($setClause, ", "); // Supprime la dernière virgule

        $sql = "UPDATE ".$this->tableName." SET $setClause WHERE id_client = ?"; // Requête SQL pour mettre à jour le profil
        $values[] = $id; // Ajoute l'ID du client aux valeurs pour la clause WHERE

        return DAO::update($sql, $values); // Exécution de la requête de mise à jour
    }

    // Méthode pour trouver un client par un token de réinitialisation de mot de passe
    public function findByResetToken($token) {
        $sql = "SELECT * FROM ".$this->tableName." WHERE resetToken = :token"; // Requête SQL pour sélectionner un client par token
        return $this->getOneOrNullResult(
            DAO::select($sql, ['token' => $token], false), // Exécution de la requête
            $this->className // Classe d'entité associée pour la conversion du résultat
        );
    }

    // Méthode pour supprimer les réservations associées à un client
    public function deleteReservationsByClientId($clientId) {
        $sql = "DELETE FROM reservations WHERE client_id = :client_id"; // Requête SQL pour supprimer les réservations
        $params = ['client_id' => $clientId]; // Données de la requête
        return DAO::delete($sql, $params); // Exécution de la requête de suppression
    }
    
    // Méthode pour supprimer un client et ses réservations associées
    public function deleteClient($clientId) {
        // D'abord, supprimez les réservations associées
        $this->deleteReservationsByClientId($clientId);
    
        // Ensuite, supprimez le client
        $sql = "DELETE FROM client WHERE id_client = :id"; // Requête SQL pour supprimer le client
        $params = ['id' => $clientId]; // Données de la requête
        return DAO::delete($sql, $params); // Exécution de la requête de suppression
    }
}
