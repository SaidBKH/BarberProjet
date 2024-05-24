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

  
    public function findByResetToken($token) {
        $sql = "SELECT * FROM ".$this->tableName." WHERE resetToken = :token";
        return $this->getOneOrNullResult(
            DAO::select($sql, ['token' => $token], false), 
            $this->className
        );
    }
    

    }