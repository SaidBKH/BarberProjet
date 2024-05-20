<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;




class ClientManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Client";
    protected $tableName = "client";

    public function __construct(){
        parent::connect();
    }
  
    public function emailExist($email) {
        $sql = "SELECT email FROM client WHERE email = :email LIMIT 1";
        $donnee = ['email' => $email];
        $result = DAO::select($sql, $donnee);

        return !empty($result);
    }

    //   public function findByEmail($email) {
    //       $sql = "SELECT * FROM user WHERE email = :email";
    //       return $this->getOneOrNullResult(
    //           DAO::select($sql, ['email' => $email]), 
    //           'Model\Entities\User'
    //       );

     public function findByEmail($email) {
         $sql = "SELECT * FROM ".$this->tableName." WHERE email = :email";
     return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email, ],false), 
             $this->className
         );
     }

     public function updatePassword($clientId, $newPasswordHash) {
        $sql = "UPDATE client SET password = :password WHERE id = :id";
        $params = ['password' => $newPasswordHash, 'id' => $clientId];
        return DAO::update($sql, $params);
    }


     public function updateProfile($id, $data) {
        $fields = array_keys($data);
        $values = array_values($data);

        $setClause = "";
        foreach ($fields as $field) {
            $setClause .= "$field = ?, ";
        }
        $setClause = rtrim($setClause, ", ");

        $sql = "UPDATE ".$this->tableName." SET $setClause WHERE id_client = ?";
        $values[] = $id;

        return DAO::update($sql, $values);
    }
    // public function updateEmail($id) {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $email = filter_input( INPUT_POST, "email", FILTER_VALIDATE_EMAIL );
    //         if ($email !== false) {
    //             $userManager = new UserManager();
    //             $userManager->updateMail($id, $mail);
    //             header("Location: index.php?ctrl=user&action=profile");
    //         exit();
    //         }
    //     }
    // }


    public function generatePasswordResetToken($email, $token) {
        $sql = "UPDATE client SET reset_token = :token WHERE email = :email";
        $params = ['token' => $token, 'email' => $email];
        return DAO::update($sql, $params);
    }
    
    public function sendPasswordResetEmail($email, $token) {
        $subject = "Réinitialisation de mot de passe";
        $message = "Bonjour,\n\nVous avez demandé à réinitialiser votre mot de passe. Veuillez cliquer sur le lien suivant pour choisir un nouveau mot de passe :\n\n";
        $message .= "http://votre-site.com/reset_password.php?email=" . urlencode($email) . "&token=" . urlencode($token);
        $headers = "From: votre-email@example.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
        // Envoi de l'e-mail
        return mail($email, $subject, $message, $headers);
    }

    
    public function resetPassword($email, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE client SET password = :password, reset_token = NULL WHERE email = :email";
        $params = ['password' => $hashedPassword, 'email' => $email];
        return DAO::update($sql, $params);
    }
    




    }