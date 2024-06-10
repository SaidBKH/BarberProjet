<?php
namespace Controller;

use App\AbstractController;
use Model\Managers\CategoryManager;
use Model\Managers\ServiceManager;
use Model\Managers\ReservationManager;
use Model\Managers\newsManager;
use Model\Managers\ContactManager;
use Model\Managers\CategoryContactManager;
use App\Session;
use Model\Entities\Reservation;

require 'libs/PHPMailer/src/Exception.php';
require 'libs/PHPMailer/src/PHPMailer.php';
require 'libs/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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

    

    
    public function sendResponse() {
        // Vérifie si la requête HTTP est une requête POST (c'est-à-dire si le formulaire a été soumis)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Filtre et valide les entrées du formulaire
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); // Valide l'email
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS); // Sanitise le nom
            $response = filter_input(INPUT_POST, 'response', FILTER_SANITIZE_SPECIAL_CHARS); // Sanitise la réponse
    
            // Vérifie que toutes les entrées sont valides
            if ($email && $name && $response) {
                // Crée une nouvelle instance de PHPMailer
                $mail = new PHPMailer(true);
    
                try {
                    // Paramètres du serveur
                    $mail->isSMTP(); // Envoie en utilisant SMTP
                    $mail->Host       = 'smtp.example.com'; // Définir le serveur SMTP pour envoyer
                    $mail->SMTPAuth   = true; // Activer l'authentification SMTP
                    $mail->Username   = 'your-email@example.com'; // Nom d'utilisateur SMTP
                    $mail->Password   = 'your-email-password'; // Mot de passe SMTP
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Activer le chiffrement TLS; `PHPMailer::ENCRYPTION_SMTPS` est recommandé
                    $mail->Port       = 587; // Port TCP pour se connecter
    
                    // Destinataires
                    $mail->setFrom('your-email@example.com', 'Admin'); // Adresse de l'expéditeur
                    $mail->addAddress($email, $name); // Ajouter un destinataire
    
                    // Contenu de l'email
                    $mail->isHTML(true); // Définir le format de l'email en HTML
                    $mail->Subject = 'Réponse à votre message'; // Sujet de l'email
                    $mail->Body    = nl2br($response); // Corps de l'email, en convertissant les nouvelles lignes en <br>
    
                    // Envoie l'email
                    $mail->send();
                    // Définit un message flash de succès
                    $this->setFlashMessage('Réponse envoyée avec succès.', 'success');
                } catch (Exception $e) {
                    // Si l'envoi échoue, définit un message flash d'erreur avec les détails de l'erreur
                    $this->setFlashMessage("Message could not be sent. Mailer Error: {$mail->ErrorInfo}", 'danger');
                }
            } else {
                // Si les entrées ne sont pas valides, définit un message flash d'erreur
                $this->setFlashMessage('Veuillez remplir tous les champs.', 'danger');
            }
        }
    
        // Redirige vers la page de liste des messages après le traitement du formulaire
        $this->redirectTo('admin', 'listMessages');

}


public function listMessages() {
    $messageManager = new ContactManager();
    $messages = $messageManager->getMessagesWithCategory();
 

    return [
        "view" => VIEW_DIR . "admin/listMessages.php",
        "meta_description" => "Liste des Messages de Contact",
        "data" => [
            "messages" => $messages,    
            
        ]
    ];
}

public function ajax($id) {

    //  $message = filter_input(INPUT_GET, 'id_messageContact', FILTER_VALIDATE_INT);

    $messageManager = new ContactManager();
        
    $message = $messageManager->findOneById($id);

      return $message;

    // // var_dump($message); exit;

            // return [
            //     "view" => VIEW_DIR . "admin/messageDetail.php",
            //     "meta_description" => "Détails du message",
            //     "data" => [
            //         "message" => $message
            //     ]
            // ];
        
    // }

}

}