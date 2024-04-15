<?php
namespace Controller;
//Un name space est un espace ou sont  grouper un ensemble d'éléments, le but est d'eviter les conflits de noms,
//si j'aiplusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\ContactManager;
use Model\Entities\Categories_message_contact;
use Model\Entities\Message_contact;




class contactController extends AbstractController implements ControllerInterface {

    public function index() {
        return [
            "view" => VIEW_DIR."contact/contact.php",
            "meta_description" => "page d'accueil",
            "data" => [                   
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
