<?php
namespace Controller;

// Importation des classes nécessaires
use App\AbstractController; // Importation de la classe de base pour les contrôleurs.
use Model\Managers\CategoryManager; // Gestion des catégories.
use Model\Managers\ServiceManager; // Gestion des services.
use Model\Managers\ReservationManager; // Gestion des réservations.
use Model\Managers\newsManager; // Gestion des actualités.
use Model\Managers\ContactManager; // Gestion des contacts.
use Model\Managers\CategoryContactManager; // Gestion des catégories de contact.
use App\Session; // Gestion des sessions.
use Model\Entities\Reservation; // Utilisation de la classe de réservation.

// Importation de la bibliothèque PHPMailer pour l'envoi de mails.
require 'libs/PHPMailer/src/Exception.php';
require 'libs/PHPMailer/src/PHPMailer.php';
require 'libs/PHPMailer/src/SMTP.php';

// Utilisation des classes PHPMailer et Exception.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Définition de la classe AdminController qui hérite d'AbstractController
class AdminController extends AbstractController {

    // Constructeur de la classe
    public function __construct() {
        // Vérifiez si l'utilisateur est connecté et s'il est administrateur
        if (!Session::getUser() || !Session::isAdmin()) {
            // Redirigez l'utilisateur non authentifié vers la page de connexion
            $this->redirectTo("security", "login");
        }
    }

    // Méthode pour afficher le tableau de bord de l'administration
    public function index() {
        return [
            "view" => VIEW_DIR . "admin/tableau_de_bord.php", // Chemin vers la vue du tableau de bord
            "meta_description" => "Tableau de bord", // Description de la page pour le SEO
            "data" => [] // Données à passer à la vue
        ];
    }

    // Méthode pour afficher le planning des réservations
    public function planning() {
        $reservationManager = new ReservationManager(); // Instanciation du manager des réservations
        $reservationsByMonth = $reservationManager->findAllGroupedByMonth(); // Récupération des réservations groupées par mois

        return [
            "view" => VIEW_DIR . "admin/planning.php", // Chemin vers la vue du planning
            "meta_description" => "planning des disponibilités", // Description de la page pour le SEO
            "data" => [
                "reservationsByMonth" => $reservationsByMonth // Données à passer à la vue
            ]
        ];
    }

    // Méthode pour afficher les réservations par jour pour un mois donné
    public function reservationsByDay($month) {
        $month = $_GET['month']; // Récupération du mois depuis les paramètres GET
        $reservationManager = new ReservationManager(); // Instanciation du manager des réservations
        $reservationsByDay = $reservationManager->findByMonthGroupedByDay($month); // Récupération des réservations par jour pour le mois donné

        return [
            "view" => VIEW_DIR . "admin/reservationsByDay.php", // Chemin vers la vue des réservations par jour
            "meta_description" => "Réservations du Mois", // Description de la page pour le SEO
            "data" => [
                "reservationsByDay" => $reservationsByDay // Données à passer à la vue
            ]
        ];
    }

    // Méthode pour afficher les réservations pour une date précise
    public function reservationsByDate($date) {
        $date = $_GET['date']; // Récupération de la date depuis les paramètres GET
        $reservationManager = new ReservationManager(); // Instanciation du manager des réservations
        $reservations = $reservationManager->findByDate($date); // Récupération des réservations pour la date donnée

        return [
            "view" => VIEW_DIR . "admin/reservationsByDate.php", // Chemin vers la vue des réservations par date
            "meta_description" => "Tableau de bord", // Description de la page pour le SEO
            "data" => [
                "reservations" => $reservations, // Données à passer à la vue
            ]
        ];
    }

    // Méthode pour créer des créneaux de réservation
    public function createTimeSlot() {
        $categoryManager = new CategoryManager(); // Instanciation du manager des catégories
        $serviceManager = new ServiceManager(); // Instanciation du manager des services
        $reservationManager = new ReservationManager(); // Instanciation du manager des réservations

        $categorys = $categoryManager->findAll(); // Récupération de la liste de toutes les catégories
        $services = []; // Initialisation du tableau des services

        // Si une catégorie est sélectionnée, récupérer les services associés
        if (isset($_POST['category_id'])) {
            $categoryId = (int)$_POST['category_id']; // Récupération de l'ID de la catégorie sélectionnée
            $services = $serviceManager->findServicesByCategory($categoryId); // Récupération des services associés à la catégorie
        }

        // Traitement du formulaire de création de réservation
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['service_id'], $_POST['dates'], $_POST['heures'])) {
            $serviceId = (int)$_POST['service_id']; // Récupération de l'ID du service sélectionné
            $dates = $_POST['dates']; // Récupération des dates sélectionnées
            $heures = $_POST['heures']; // Récupération des heures sélectionnées

            if ($serviceId && $dates && $heures) {
                foreach ($dates as $date) {
                    foreach ($heures as $heure) {
                        $reservationData = [
                            'service_id' => $serviceId,
                            'date' => $date,
                            'heure' => $heure,
                        ];
                        $reservationManager->add($reservationData); // Ajout de la réservation
                    }
                }
                $this->setFlashMessage('Réservations créées avec succès'); // Message de succès
                $this->redirectTo("admin", "createTimeSlot"); // Redirection après succès
            } else {
                $this->setFlashMessage('Veuillez remplir tous les champs'); // Message d'erreur
            }
        }

        return [
            "view" => VIEW_DIR . "admin/createTimeSlot.php", // Chemin vers la vue de création de créneaux
            "meta_description" => "Tableau de bord", // Description de la page pour le SEO
            "data" => [
                "categorys" => $categorys, // Données des catégories à passer à la vue
                "services" => $services, // Données des services à passer à la vue
            ]
        ];
    }

    // Méthode pour annuler des créneaux de réservation
    public function annulerCreneau() {
        $reservationManager = new ReservationManager(); // Instanciation du manager des réservations
        $message = ''; // Initialisation du message
        $dates = $reservationManager->getAvailableDates(); // Récupération des dates disponibles
        $reservations = []; // Initialisation du tableau des réservations
        $selectedDate = null; // Initialisation de la date sélectionnée

        // Si une date est sélectionnée, récupérer les réservations associées
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_date'])) {
            $selectedDate = $_POST['selected_date']; // Récupération de la date sélectionnée
            $reservations = $reservationManager->annulerByDate($selectedDate); // Annulation des réservations pour la date donnée
        }

        // Si un créneau est à annuler
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['annuler_creneau'])) {
            $creneauId = (int)$_POST['creneau_id']; // Récupération de l'ID du créneau à annuler
            $reservationManager->delete($creneauId); // Suppression du créneau
            $message = 'Créneau annulé avec succès'; // Message de succès
            $this->redirectTo("admin", "annulerCreneau"); // Redirection après succès
        }

        return [
            "view" => VIEW_DIR . "admin/annulerCreneau.php", // Chemin vers la vue d'annulation de créneaux
            "meta_description" => "Annuler des créneaux", // Description de la page pour le SEO
            "data" => [
                "dates" => $dates, // Données des dates à passer à la vue
                "selectedDate" => $selectedDate, // Données de la date sélectionnée à passer à la vue
                "reservations" => $reservations, // Données des réservations à passer à la vue
                "message" => $message // Message à passer à la vue
            ]
        ];
    }

    // Méthode pour créer des actualités
    public function createNews() {
        $newsManager = new newsManager(); // Instanciation du manager des actualités
        $message = ''; // Initialisation du message

        // Traitement du formulaire de création des actualités
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['photo'], $_POST['text'], $_POST['date'])) {
            $title = $_POST['title']; // Récupération du titre
            $photo = $_POST['photo']; // Récupération de la photo
            $text = $_POST['text']; // Récupération du texte
            $date = $_POST['date']; // Récupération de la date

            if ($title && $photo && $text && $date) {
                $newsData = [
                    'title' => $title,
                    'photo' => $photo,
                    'text' => nl2br($text), // Conversion des nouvelles lignes en <br>
                    'date' => $date
                ];
                $newsManager->add($newsData); // Ajout de l'actualité
                $message = 'Actualité créée avec succès'; // Message de succès
            } else {
                $message = 'Veuillez remplir tous les champs'; // Message d'erreur
            }
        }

        return [
            "view" => VIEW_DIR . "admin/createNews.php", // Chemin vers la vue de création des actualités
            "meta_description" => "Créer une actualité", // Description de la page pour le SEO
            "data" => [
                "message" => $message // Message à passer à la vue
            ]
        ];
    }

    // Méthode pour envoyer une réponse par email
    // public function sendResponse() {
    //     // Vérifie si la requête HTTP est une requête POST (c'est-à-dire si le formulaire a été soumis)
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         // Filtre et valide les entrées du formulaire
    //         $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); // Valide l'email
    //         $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS); // Sanitise le nom
    //         $response = filter_input(INPUT_POST, 'response', FILTER_SANITIZE_SPECIAL_CHARS); // Sanitise la réponse

    //         // Vérifie que toutes les entrées sont valides
    //         if ($email && $name && $response) {
    //             // Crée une nouvelle instance de PHPMailer
    //             $mail = new PHPMailer(true);

    //             try {
    //                 // Paramètres du serveur
    //                 $mail->isSMTP(); // Envoie en utilisant SMTP
    //                 $mail->Host       = 'smtp.example.com'; // Définir le serveur SMTP pour envoyer
    //                 $mail->SMTPAuth   = true; // Activer l'authentification SMTP
    //                 $mail->Username   = 'your-email@example.com'; // Nom d'utilisateur SMTP
    //                 $mail->Password   = 'your-email-password'; // Mot de passe SMTP
    //                 $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Activer le chiffrement TLS; `PHPMailer::ENCRYPTION_SMTPS` est recommandé
    //                 $mail->Port       = 587; // Port TCP pour se connecter

    //                 // Destinataires
    //                 $mail->setFrom('your-email@example.com', 'Admin'); // Adresse de l'expéditeur
    //                 $mail->addAddress($email, $name); // Ajouter un destinataire

    //                 // Contenu de l'email
    //                 $mail->isHTML(true); // Définir le format de l'email en HTML
    //                 $mail->Subject = 'Réponse à votre message'; // Sujet de l'email
    //                 $mail->Body    = nl2br($response); // Corps de l'email, en convertissant les nouvelles lignes en <br>

    //                 // Envoie l'email
    //                 $mail->send();
    //                 // Définit un message flash de succès
    //                 $this->setFlashMessage('Réponse envoyée avec succès.', 'success');
    //             } catch (Exception $e) {
    //                 // Si l'envoi échoue, définit un message flash d'erreur avec les détails de l'erreur
    //                 $this->setFlashMessage("Message could not be sent. Mailer Error: {$mail->ErrorInfo}", 'danger');
    //             }
    //         } else {
    //             // Si les entrées ne sont pas valides, définit un message flash d'erreur
    //             $this->setFlashMessage('Veuillez remplir tous les champs.', 'danger');
    //         }
    //     }

    //     // Redirige vers la page de liste des messages après le traitement du formulaire
    //     $this->redirectTo('admin', 'listMessages');
    // }

    // Méthode pour lister les messages de contact
    public function listMessages() {
        $messageManager = new ContactManager(); // Instanciation du manager des contacts
        $messages = $messageManager->getMessagesWithCategory(); // Récupération des messages avec leur catégorie

        return [
            "view" => VIEW_DIR . "admin/listMessages.php", // Chemin vers la vue de la liste des messages
            "meta_description" => "Liste des Messages de Contact", // Description de la page pour le SEO
            "data" => [
                "messages" => $messages, // Données des messages à passer à la vue
            ]
        ];
    }

    // Méthode pour afficher un message en détail via AJAX
    public function ajax($id) {
        $messageManager = new ContactManager(); // Instanciation du manager des contacts
        $message = $messageManager->findOneById($id); // Récupération du message par ID

        // Inclure la vue partielle et passer la variable $message
        include(VIEW_DIR . "admin/messageDetail.php");
    }

    // Méthode pour supprimer des messages
    public function deleteMessages() {
        $messageIds = filter_input(INPUT_POST, 'messageIds', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY); // Récupération des IDs des messages à supprimer

        if ($messageIds) {
            $messageManager = new ContactManager(); // Instanciation du manager des contacts
            foreach ($messageIds as $id) {
                $messageManager->delete($id); // Suppression de chaque message
            }
            $_SESSION['flash_message'] = ['message' => 'Messages supprimés avec succès.']; // Message de succès
        } else {
            $_SESSION['flash_message'] = ['message' => 'Aucun message sélectionné.']; // Message d'erreur
        }

        // Rediriger vers la page des messages après suppression
        header('Location: ?ctrl=admin&action=listMessages');
        exit();
    }
}
