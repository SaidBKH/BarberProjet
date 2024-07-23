<?php
namespace Controller;

// Un namespace est un espace où sont groupés un ensemble d'éléments pour éviter les conflits de noms.
// Si j'ai plusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas.

use App\AbstractController;
use App\ControllerInterface;

class MentionsController extends AbstractController implements ControllerInterface {

    // PAGE POLITIQUE DE CONFIDENTIALITÉ
    public function index() {
        return [
            "view" => VIEW_DIR . "mentions/politique_confidentialite.php", // Chemin vers la vue de la politique de confidentialité
            "meta_description" => "politique de confidentialité du site", // Description de la page pour le SEO
            "data" => [] 
        ];
    }

    // PAGE MENTIONS LÉGALES
    public function mentionLegal() {
        return [
            "view" => VIEW_DIR . "mentions/mention_legal.php", // Chemin vers la vue des mentions légales
            "meta_description" => "politique de confidentialité du site", // Description de la page pour le SEO
            "data" => [] 
        ];
    }
}
