<?php
namespace Controller;
//Un name space est un espace ou sont  grouper un ensemble d'éléments, le but est d'eviter les conflits de noms,
//si j'aiplusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\GalerieManager;
use Model\Managers\CategoryContactManager;
use Model\Managers\contactManager;



class HomeController extends AbstractController implements ControllerInterface {


        // HOME PAGE

    public function index()
    {
        // Instanciez le GalerieManager
        $galerieManager = new GalerieManager();

        // Récupérez les images
        $images = $galerieManager->findAll();; 
        // Transmettez les données à la vue
        return [
            "view" => VIEW_DIR . "home/home.php",
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
    $categoryContactManager = new CategoryContactManager();
    $categorys = $categoryContactManager->findAll();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
        $categoryContactId = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);

        // Vérification des erreurs
        if (empty($name) || empty($email) || empty($message) || !$categoryContactId) {
            $this->setFlashMessage("Erreur : Veuillez remplir tous les champs du formulaire.");
        } elseif (!$email) {
            $this->setFlashMessage("Erreur : L'adresse email n'est pas valide.");
        } elseif (!in_array($categoryContactId, [1, 2, 3,4,5])) {
            $this->setFlashMessage("Erreur : Catégorie de message invalide.");
        } else {
            // Ajout du message si aucune erreur n'est détectée
            $contactManager = new ContactManager();
            $contactManager->add([
                'name' => $name,
                'email' => $email,
                'message' => $message,
                'dateCreation' => date('Y-m-d H:i:s'),
                'categoryContact_id' => $categoryContactId,
            ]);

            // Redirection vers la page de confirmation
            $this->redirectTo('Home', 'confirmationContact');
        }
    }

    return [
        'view' => VIEW_DIR . 'contact/contact.php',
        'meta_description' => 'page de contact',
        'data' => [
            'categorys' => $categorys
        ]
    ];
}

    public function confirmationContact() {
        return [
            "view" => VIEW_DIR."contact/confirmationContact.php",
            "meta_description" => "page d'accueil",
            "data" => [                   
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
