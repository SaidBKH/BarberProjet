<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\ContactManager;
use Model\Managers\CategorieContactManager;

class ContactController extends AbstractController implements ControllerInterface {

    public function index() {
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
}
