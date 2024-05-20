<?php
namespace Controller;

use App\AbstractController;
use Model\Managers\ReservationManager;

use App\Session;

class AdminController extends AbstractController {

    public function __construct() {
        // Vérifiez si l'utilisateur est connecté et s'il est administrateur
        if (!Session::getUser() || !Session::isAdmin()) {
            // Redirigez l'utilisateur non authentifié vers la page de connexion
            $this->redirectTo("security", "login");
        }
    }

    public function index() {
        // Instanciation du manager des réservations
        $reservationManager = new ReservationManager();

        // Récupération des réservations à afficher dans le tableau de bord
        $reservations = $reservationManager->findAll();

        return [
            "view" => VIEW_DIR . "admin/index.php",
            "meta_description" => "Tableau de bord",
            "data" => [
                "reservations" => $reservations
            ]
        ];
    }
    // public function reservations() {
    //     $reservationManager = new ReservationManager();
    //     // Obtenez toutes les réservations depuis le gestionnaire de réservations
    //     // $reservations = $reservationManager->getAllReservations();

    //     // Retournez les données à afficher dans la vue
    //     return [
    //         "view" => VIEW_DIR . "admin/reservations.php",
    //         "meta_description" => "Liste des réservations",
    //         "data" => [
    //             // "reservations" => $reservations
    //         ]
    //     ];
    }

    // Vous pouvez ajouter d'autres méthodes pour gérer les autres fonctionnalités de l'interface d'administration

