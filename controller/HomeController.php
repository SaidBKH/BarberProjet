<?php
namespace Controller;
//Un name space est un espace ou sont  grouper un ensemble d'éléments, le but est d'eviter les conflits de noms,
//si j'aiplusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategorieManager;
use Model\Managers\ServiceManager;



class HomeController extends AbstractController implements ControllerInterface {

        public function index() {
        
            // créer une nouvelle instance de CategorieManager
            $categorieManager = new CategorieManager();
            $serviceManager= new ServiceManager();
            // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
            $categories = $categorieManager->findAll(["nomCategorie", "DESC"]);
            $services = $serviceManager->findAll(["nom", "DESC"]);
            // le controller communique avec la vue "listCategorie" (view) pour lui envoyer la liste des catégories (data)
            return [
                "view" => VIEW_DIR."barber/listCategorie.php",
                "meta_description" => "Liste des catégories du site",
                "data" => [
                    "categories" => $categories,
                    "services" =>$services
                ]
            ];
        }
    }     

    
//     public function users(){
//         $this->restrictTo("ROLE_USER");

//         $manager = new UserManager();
//         $users = $manager->findAll(['registerDate', 'DESC']);

//         return [
//             "view" => VIEW_DIR."security/users.php",
//             "meta_description" => "Liste des utilisateurs du forum",
//             "data" => [ 
//                 "users" => $users 
//             ]
//         ];
//     }
// }
