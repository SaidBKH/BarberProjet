<?php
namespace Controller;
//Un name space est un espace ou sont  grouper un ensemble d'éléments, le but est d'eviter les conflits de noms,
//si j'aiplusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\GalerieManager;




class HomeController extends AbstractController implements ControllerInterface {

    public function index()
    {
        // Instanciez le GalerieManager
        $galerieManager = new GalerieManager();

        // Récupérez les images
        $images = $galerieManager->findAll(); 

        // Transmettez les données à la vue
        return [
            "view" => VIEW_DIR . "accueil/home.php",
            "meta_description" => "accueil",
            "data" => [
                "images" => $images,
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
