<?php
namespace Controller;
//Un name space est un espace ou sont  grouper un ensemble d'éléments, le but est d'eviter les conflits de noms,
//si j'aiplusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\GalerieManager;
use Model\Managers\categorieContactManager;
use Model\Managers\contactManager;







class accueilController extends AbstractController implements ControllerInterface {




        // HOME PAGE

    public function index()
    {
        // Instanciez le GalerieManager
        $galerieManager = new GalerieManager();

        // Récupérez les images
        $images = $galerieManager->findAll();; 
        // Transmettez les données à la vue
        return [
            "view" => VIEW_DIR . "accueil/home.php",
            "meta_description" => "accueil",
            "data" => [
                "images" => $images,
            ]
        ];
    }




    // PAGE NOUS REJOINDRES
    public function joinUs() {
        return [
            "view" => VIEW_DIR."joinUs/joinUs.php",
            "meta_description" => "page d'accueil",
            "data" => [                   
            ]
        ];
    }

//  PAGE CONTACT

    public function contact() {
        $categorieContactManager = new CategorieContactManager();
        $categories = $categorieContactManager->findAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
            $categorieContactId = filter_input(INPUT_POST, 'categorie', FILTER_VALIDATE_INT);

            if ($nom && $email && $message && $categorieContactId) {
                $contactManager = new ContactManager();
                $contactManager->add([
                    'nom' => $nom,
                    'email' => $email,
                    'message' => $message,
                    'dateCreation' => date('Y-m-d H:i:s'),
                    'categorieContact_id' => $categorieContactId,
                ]);

                // Rediriger ou afficher un message de succès
                $this->redirectTo('contact', 'index');
            } else {
                // Gérer les erreurs de validation
            }
        }

        return [
            'view' => VIEW_DIR . 'contact/contact.php',
            'meta_description' => 'page de contact',
            'data' => [
                'categories' => $categories
            ]
        ];
    }



//  PAGE NOS SERVICES

    public function ourServices() {
        return [
            "view" => VIEW_DIR."ourServices/ourServices.php",
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
