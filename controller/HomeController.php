<?php
namespace Controller;

// Un namespace est un espace où sont groupés un ensemble d'éléments pour éviter les conflits de noms.
// Si j'ai plusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas.

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\GalerieManager;
use Model\Managers\CategoryContactManager;
use Model\Managers\ContactManager;

class HomeController extends AbstractController implements ControllerInterface {

    // HOME PAGE
    public function index() {
        // Instancie le GalerieManager
        $galerieManager = new GalerieManager();

        // Récupère les images
        $images = $galerieManager->findAll(); 

        // Transmet les données à la vue
        return [
            "view" => VIEW_DIR . "home/home.php", // Chemin vers la vue de la page d'accueil
            "meta_description" => "accueil", // Description de la page pour le SEO
            "data" => [
                "images" => $images, // Données à passer à la vue
            ]
        ];
    }

    // PAGE NOUS REJOINDRES
    public function joinUs() {
        return [
            "view" => VIEW_DIR . "joinUs/joinUs.php", // Chemin vers la vue de la page "Nous Rejoindre"
            "meta_description" => "page d'accueil", // Description de la page pour le SEO
            "data" => [] 
        ];
    }

    // PAGE CONTACT
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
            } elseif (!in_array($categoryContactId, [1, 2, 3, 4, 5])) {
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
            'view' => VIEW_DIR . 'contact/contact.php', // Chemin vers la vue de la page de contact
            'meta_description' => 'page de contact', // Description de la page pour le SEO
            'data' => [
                'categorys' => $categorys // Données à passer à la vue
            ]
        ];
    }

    // PAGE DE CONFIRMATION DE CONTACT
    public function confirmationContact() {
        return [
            "view" => VIEW_DIR . "contact/confirmationContact.php", // Chemin vers la vue de confirmation de contact
            "meta_description" => "page d'accueil", // Description de la page pour le SEO
            "data" => [] 
        ];
    }

    // PAGE NOS SERVICES
    public function ourServices() {
        return [
            "view" => VIEW_DIR . "ourServices/ourServices.php", // Chemin vers la vue de la page "Nos Services"
            "meta_description" => "page d'accueil", // Description de la page pour le SEO
            "data" => [] 
        ];
    }
}
