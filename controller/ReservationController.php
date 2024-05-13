<?php
namespace Controller;
//Un name space est un espace ou sont  grouper un ensemble d'éléments, le but est d'eviter les conflits de noms,
//si j'aiplusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategorieManager;
use Model\Managers\ServiceManager;
use Model\Managers\ClientManager;



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
                "services" =>$services                  
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
    
            $planning = $reservationManager->listDisponibiliteByService($serviceId);
    
            // Retourner le résultat pour être utilisé dans la vue
            return [
                "view" => VIEW_DIR . "reservation/planningByService.php",
                "meta_description" => "Planning",
                "data" => [
                    "planning" => $planning
                ]
            ];
        }
        }



