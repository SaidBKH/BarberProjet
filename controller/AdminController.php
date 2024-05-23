<?php
namespace Controller;

use App\AbstractController;
use Model\Managers\CategorieManager;
use Model\Managers\ServiceManager;
use Model\Managers\ReservationManager;
use Model\Managers\ActualitesManager;
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

    public function GestionReservation() {
     

        return [
            "view" => VIEW_DIR . "admin/GestionReservation.php",
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


    public function creerReservation() {
        $categorieManager = new CategorieManager();
        $serviceManager = new ServiceManager();
        $reservationManager = new ReservationManager();
    
        // Récupérer la liste de toutes les catégories
        $categories = $categorieManager->findAll();
        $services = [];
        $message = '';
    
        // Si une catégorie est sélectionnée, récupérer les services associés
        if (isset($_POST['categorie_id'])) {
            $categorieId = (int)$_POST['categorie_id'];
            $services = $serviceManager->findServicesByCategory($categorieId);
        }
    
        // Traitement du formulaire de création de réservation
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['service_id'], $_POST['dates'], $_POST['heures'])) {
            $serviceId = (int)$_POST['service_id'];
            $dates = $_POST['dates'];
            $heures = $_POST['heures'];
    
            if ($serviceId && $dates && $heures) {
                foreach ($dates as $date) {
                    foreach ($heures as $heure) {
                        $reservationData = [
                            'service_id' => $serviceId,
                            'date' => $date,
                            'heure' => $heure,
                        ];
                        $reservationManager->add($reservationData);
                    }
                }
                $message = 'Réservations créées avec succès';
                $this->redirectTo("admin", "tableau_de_bord");
            } else {
                $message = 'Veuillez remplir tous les champs';
            }
        }
    
        return [
            "view" => VIEW_DIR . "admin/creerReservation.php",
            "meta_description" => "Tableau de bord",
            "data" => [
                "categories" => $categories,
                "services" => $services,
                "message" => $message
            ]
        ];
    }
    
    
    
    
    public function creerActualite() {
        $actualiteManager = new ActualitesManager();
        $message = '';
    
        // Traitement du formulaire de création d'actualité
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titre'], $_POST['photo'], $_POST['texte'], $_POST['date'])) {
            $titre = $_POST['titre'];
            $photo = $_POST['photo'];
            $texte = $_POST['texte'];
            $date = $_POST['date'];
    
            if ($titre && $photo && $texte && $date) {
                $actualiteData = [
                    'titre' => $titre,
                    'photo' => $photo,
                    'texte' => $texte,
                    'date' => $date
                ];
    
                $actualiteManager->add($actualiteData);
                $message = 'Actualité créée avec succès';
            } else {
                $message = 'Veuillez remplir tous les champs';
            }
        }
    
        return [
            "view" => VIEW_DIR . "admin/creerActualite.php",
            "meta_description" => "Créer une actualité",
            "data" => [
                "message" => $message
            ]
        ];
    }
    
}

