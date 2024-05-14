<?php
namespace Controller;
//Un name space est un espace ou sont  grouper un ensemble d'éléments, le but est d'eviter les conflits de noms,
//si j'aiplusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategorieManager;
use Model\Managers\ServiceManager;
use Model\Managers\ClientManager;
use Model\Managers\ReservationManager;




class ReservationController extends AbstractController implements ControllerInterface {

        public function index() {
            $categorieManager = new CategorieManager();
            $serviceManager= new ServiceManager();
            // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
            $categories = $categorieManager->findAll(["nomCategorie", "DESC"]);
            $services = $serviceManager->findAll(["nom", "DESC"]); 


            return [
                "view" => VIEW_DIR."reservation/listCategories.php",
                "meta_description" => "accueil",
                "data" => [
                    "categories" => $categories,
                "services" =>$services, 
                

                ]
            ];
        }


        public function listServiceByCategory($id) {

            $categorieManager = new CategorieManager();
            $serviceManager = new ServiceManager();
            $categorie = $categorieManager->findOneById($id);
            $services = $serviceManager->findServicesByCategory($id);
    
            return [
                "view" => VIEW_DIR."reservation/listServices.php",
                "meta_description" => "Liste des services ",
                "data" => [
                    "categorie" => $categorie,
                    "services" => $services
                ]
            ];
        }

        public function planningByService($id)
        {
            $reservationManager = new ReservationManager();
            $serviceManager = new ServiceManager();
        
            // Récupérer les services pour affichage
            $services = $serviceManager->findServicesByCategory($id);
        
            // Récupérer les plannings disponibles pour ce service
            $planning = $reservationManager->listDispo($id);
        
            return [
                "view" => VIEW_DIR . "reservation/planning.php",
                "meta_description" => "Planning",
                "data" => [
                    "planning" => $planning,
                    "services" => $services
                ]
            ];
        }




        public function reserve() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                // Récupérer l'heure sélectionnée depuis le formulaire
                $heureSelectionnee = isset($_POST['heure_selectionnee']) ? $_POST['heure_selectionnee'] : '';
                $serviceId = isset($_POST['service_id']) ? $_POST['service_id'] : '';
                
                // Récupérer l'ID du client à partir de la session
                $clientId = $_SESSION['client']->getId();
                
                // Créer une nouvelle instance de Reservation avec les données
                $reservationData = [
                    'heure' => str_replace("\n", "",(str_replace(" ", "", $heureSelectionnee))),
                    'date' => date('Y-m-d'), 
                    'service_id' => $serviceId, 
                    'client_id' => $clientId 
                ];
                
                // Créer une instance de ReservationManager et créer la réservation
                $reservationManager = new ReservationManager();
                $reservationManager->add($reservationData);
                

            }
            header('Location: index.php?action=reservation_confirm');
            //     
        }
        
}







