<?php
namespace Controller;

// Un namespace est un espace où sont groupés un ensemble d'éléments pour éviter les conflits de noms.
// Si j'ai plusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas.

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\NewsManager;

class NewsController extends AbstractController implements ControllerInterface {

    // PAGE D'ACTUALITÉS
    public function index() {
        $newsManager = new NewsManager();

        // Récupère les publications
        $publications = $newsManager->findAll();

        // Transmet les données à la vue
        return [
            "view" => VIEW_DIR . "news/news.php", // Chemin vers la vue de la page d'actualités
            "meta_description" => "accueil", // Description de la page pour le SEO
            "data" => [
                "publications" => $publications, // Données à passer à la vue
            ]
        ];
    }
}
