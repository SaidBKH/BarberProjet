<?php
namespace Controller;

use App\AbstractController;
use Model\Managers\CategoryManager;
use Model\Managers\ServiceManager;
use Model\Managers\ReservationManager;
use Model\Managers\newsManager;
use Model\Managers\ContactManager;

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
            "meta_description" => "planning des disponibilités",
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



    public function createTimeSlot() {
        $categoryManager = new CategoryManager();
        $serviceManager = new ServiceManager();
        $reservationManager = new ReservationManager();
    
        // Récupérer la liste de toutes les catégories
        $categorys = $categoryManager->findAll();
        $services = [];
    
        // Si une catégorie est sélectionnée, récupérer les services associés
        if (isset($_POST['category_id'])) {
            $categoryId = (int)$_POST['category_id'];
            $services = $serviceManager->findServicesByCategory($categoryId);
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
                $this->setFlashMessage('Réservations créées avec succès');
                
                $this->redirectTo("admin", "createTimeSlot");
            } else {
                $this->setFlashMessage('Veuillez remplir tous les champs');

            }
        }
    
        return [
            "view" => VIEW_DIR . "admin/createTimeSlot.php",
            "meta_description" => "Tableau de bord",
            "data" => [
                "categorys" => $categorys,
                "services" => $services,
            ]
        ];
    }
    
    

    

    public function annulerCreneau() {
        $reservationManager = new ReservationManager();
        $message = '';
        $dates = $reservationManager->getAvailableDates();
        $reservations = [];
        $selectedDate = null;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_date'])) {
            $selectedDate = $_POST['selected_date'];
            $reservations = $reservationManager->annulerByDate($selectedDate);
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['annuler_creneau'])) {
            $creneauId = (int)$_POST['creneau_id'];
            $reservationManager->delete($creneauId);
            $message = 'Créneau annulé avec succès';
            $this->redirectTo("admin", "annulerCreneau");
        }
    
        return [
            "view" => VIEW_DIR . "admin/annulerCreneau.php",
            "meta_description" => "Annuler des créneaux",
            "data" => [
                "dates" => $dates,
                "selectedDate" => $selectedDate,
                "reservations" => $reservations,
                "message" => $message
            ]
        ];
    }
    
    public function createNews() {
        $newsManager = new newsManager();
        $message = '';
    
        // Traitement du formulaire de création des news 
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['photo'], $_POST['text'], $_POST['date'])) {
            $title = $_POST['title'];
            $photo = $_POST['photo'];
            $text = $_POST['text'];
            $date = $_POST['date'];
    
            if ($title && $photo && $text && $date) {
                $newsData = [
                    'title' => $title,
                    'photo' => $photo,
                    'text' => $text,
                    'date' => $date
                ];
    
                $newsManager->add($newsData);
                $message = 'Actualité créée avec succès';
            } else {
                $message = 'Veuillez remplir tous les champs';
            }
        }
    
        return [
            "view" => VIEW_DIR . "admin/createNews.php",
            "meta_description" => "Créer une actualité",
            "data" => [
                "message" => $message
            ]
        ];
    }

    
    public function listMessages() {
        $messageManager = new ContactManager();
        $messages = $messageManager->findAll(["dateCreation", "DESC"]);

        return [
            "view" => VIEW_DIR . "admin/listMessages.php",
            "meta_description" => "Liste des Messages de Contact",
            "data" => [
                "messages" => $messages
            ]
        ];
    }
    
    

}
