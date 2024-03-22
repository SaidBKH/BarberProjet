<?php
namespace Controller;
//Un name space est un espace ou sont  grouper un ensemble d'éléments, le but est d'eviter les conflits de noms,
//si j'aiplusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategorieManager;
use Model\Managers\ServiceManager;



class BarberController extends AbstractController implements ControllerInterface {

        public function index() {
        
            
            return [
                "view" => VIEW_DIR."barber/listCategorie.php",
                "meta_description" => "Liste des Service du site",
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
