<?php
namespace Controller;

use App\AbstractController;
use Model\Managers\ReservationManager;
use App\Session;
use Model\Entities\Reservation;


class AdminController extends AbstractController {

    public function __construct() {
        // Vérifiez si l'utilisateur est connecté et s'il est administrateur
        if (!Session::getUser() || !Session::isAdmin()) {
            // Redirigez l'utilisateur non authentifié vers la page de connexion
            $this->redirectTo("security", "login");
        }
    }


    public function index() {
        

        return [
            "view" => VIEW_DIR . "admin/tableau_de_bord.php",
            "meta_description" => "Tableau de bord",
            "data" => [
            ]
        ];
    }
    
    public function planning() {
        $reservationManager = new ReservationManager();
        $reservationsByMonth = $reservationManager->findAllGroupedByMonth();

        return [
            "view" => VIEW_DIR . "admin/planning.php",
            "meta_description" => "Tableau de bord",
            "data" => [
                "reservationsByMonth" => $reservationsByMonth
            ]
        ];
    }

    public function reservationsByDay($month) {
        $month = $_GET['month'];
        // Instanciation du manager des réservations
        $reservationManager = new ReservationManager();
    
        // Récupération des réservations par jour pour le mois donné
        $reservationsByDay = $reservationManager->findByMonthGroupedByDay($month);
        return [
            "view" => VIEW_DIR . "admin/reservationsByDay.php",
            "meta_description" => "Réservations du Mois",
            "data" => [
                "reservationsByDay" => $reservationsByDay
            ]
        ];
    }
    



    public function reservationsByDate($date) {
        $date = $_GET['date'];

        $reservationManager = new ReservationManager();
        $reservations = $reservationManager->findByDate($date);
        // var_dump($reservations);
    
        return [
            "view" => VIEW_DIR . "admin/reservationsByDate.php",
            "meta_description" => "Tableau de bord",
            "data" => [
                "reservations" => $reservations,
            ]
        ];
    }
    
}


