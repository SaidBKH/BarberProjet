<?php
namespace Controller;

// Un namespace est un espace de noms où sont groupés un ensemble d'éléments.
// Le but est d'éviter les conflits de noms : si j'ai plusieurs fichiers portant le même nom,
// tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas.

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\ServiceManager;
use Model\Managers\ReservationManager;

// Déclaration de la classe ReservationController qui hérite d'AbstractController et implémente ControllerInterface
class ReservationController extends AbstractController implements ControllerInterface {

    // Méthode index : point d'entrée principal
    public function index() {
        $categoryManager = new CategoryManager();  // Instanciation du gestionnaire de catégories
        $serviceManager = new ServiceManager();    // Instanciation du gestionnaire de services
        
        // Récupérer la liste de toutes les catégories triées par nom (descendant)
        $categorys = $categoryManager->findAll(["categoryName", "DESC"]);
        // Récupérer la liste de tous les services triés par nom (descendant)
        $services = $serviceManager->findAll(["name", "DESC"]); 

        // Retourne un tableau contenant la vue, la meta description et les données (catégories et services)
        return [
            "view" => VIEW_DIR."reservation/listCategorys.php",
            "meta_description" => "accueil",
            "data" => [
                "categorys" => $categorys,
                "services" => $services,
            ]
        ];
    }

    // Méthode pour lister les services par catégorie
    public function listServiceByCategory($id) {
        $categoryManager = new CategoryManager(); // Instanciation du gestionnaire de catégories
        $serviceManager = new ServiceManager();   // Instanciation du gestionnaire de services
        
        // Récupérer une catégorie spécifique par ID
        $category = $categoryManager->findOneById($id);
        // Récupérer les services associés à cette catégorie
        $services = $serviceManager->findServicesByCategory($id);

        // Retourne un tableau contenant la vue, la meta description et les données (catégorie et services)
        return [
            "view" => VIEW_DIR."reservation/listServices.php",
            "meta_description" => "Liste des services",
            "data" => [
                "category" => $category,
                "services" => $services
            ]
        ];
    }

    // Méthode pour afficher le planning d'un service spécifique
    public function planningByService($id) {
        $reservationManager = new ReservationManager(); // Instanciation du gestionnaire de réservations
        $serviceManager = new ServiceManager();         // Instanciation du gestionnaire de services
        
        // Récupérer un service spécifique par ID
        $service = $serviceManager->findOneById($id);
        // Récupérer les disponibilités (plannings) pour ce service
        $planning = $reservationManager->listDispo($id);

        // Retourne un tableau contenant la vue, la meta description et les données (planning et service)
        return [
            "view" => VIEW_DIR . "reservation/planning.php",
            "meta_description" => "Planning",
            "data" => [
                "planning" => $planning,
                "service" => $service,
            ]
        ];
    }

    // Méthode pour réserver un service
    public function reserve() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifier si la requête est de type POST

            // Récupérer l'heure sélectionnée depuis le formulaire
            $heureSelectionnee = isset($_POST['heure_selectionnee']) ? $_POST['heure_selectionnee'] : '';
            // Récupérer le service sélectionné depuis le formulaire
            $serviceId = isset($_POST['service_id']) ? $_POST['service_id'] : '';
            // Récupérer la date sélectionnée depuis le formulaire
            $dateId = isset($_POST['date']) ? $_POST['date'] : '';

            // Récupérer l'ID du client à partir de la session
            $clientId = $_SESSION['client']->getId();
            
            // Préparer les données de la réservation
            $reservationData = [
                'heure' => str_replace("\n", "", (str_replace(" ", "", $heureSelectionnee))),
                'date' => $dateId, 
                'service_id' => $serviceId, 
                'client_id' => $clientId 
            ];

            // Instanciation du gestionnaire de réservations et création de la réservation
            $reservationManager = new ReservationManager();
            $reservationManager->updateReservation($heureSelectionnee, $dateId, $serviceId, $clientId);
            
            // Rediriger vers la page de confirmation de réservation
            $this->redirectTo("Reservation", "confirmationReservation");
        }
    }

    // Méthode pour annuler une réservation
    public function AnnulerReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifier si la requête est de type POST
            // Récupérer l'ID de la réservation depuis le formulaire en s'assurant qu'il soit un entier valide
            $reservationId = filter_input(INPUT_POST, 'reservation_id', FILTER_VALIDATE_INT);

            if ($reservationId) {
                $reservationManager = new ReservationManager(); // Instanciation du gestionnaire de réservations
                // Annuler la réservation
                $success = $reservationManager->AnnulerReservation($reservationId);

                if ($success) {
                    echo "Réservation annulée avec succès.";
                } else {
                    echo "Erreur lors de l'annulation de la réservation.";
                }
            }

            // Rediriger vers la page de profil
            $this->redirectTo("security", "profil");
        }
    }

    // Méthode pour afficher la confirmation de réservation
    public function confirmationReservation() {
        return [
            "view" => VIEW_DIR . "reservation/confirmationReservation.php",
            "meta_description" => "Confirmation de Réservation"
        ];
    }
}
