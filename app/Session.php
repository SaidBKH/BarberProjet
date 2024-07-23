<?php
namespace App;

class Session{

    // Catégories de messages possibles : 'error' pour les erreurs, 'success' pour les succès
    private static $categories = ['error', 'success'];

    /**
     * Ajoute un message en session, dans la catégorie $categ
     */
    public static function addFlash($categ, $msg){
        // Enregistre le message dans la catégorie donnée (par exemple 'error' ou 'success')
        $_SESSION[$categ] = $msg;
    }

    /**
     * Renvoie un message de la catégorie $categ, s'il y en a un !
     */
    public static function getFlash($categ){
        // Si un message existe dans la catégorie, le récupérer et le supprimer ensuite
        if(isset($_SESSION[$categ])){
            $msg = $_SESSION[$categ];  
            unset($_SESSION[$categ]);
        }
        // Sinon, renvoyer une chaîne vide
        else $msg = "";
        
        return $msg;
    }

    /**
     * Met un utilisateur dans la session (pour le maintenir connecté)
     */
    public static function setUser($user){
        // Enregistre l'utilisateur dans la session sous la clé 'client'
        $_SESSION["client"] = $user;
    }

    // Récupère l'utilisateur de la session, ou renvoie false s'il n'y en a pas
    public static function getUser(){
        return (isset($_SESSION['client'])) ? $_SESSION['client'] : false;
    }

    // Vérifie si l'utilisateur connecté est un administrateur
    public static function isAdmin(){
        // Si l'utilisateur est connecté et qu'il a le rôle 'admin', renvoyer true
        if(self::getUser() && self::getUser()->hasRole("admin")){
            return true;
        }
        // Sinon, renvoyer false
        return false;
    }
}
