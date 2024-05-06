<?php
namespace Controller;
//Un name space est un espace ou sont  grouper un ensemble d'éléments, le but est d'eviter les conflits de noms,
//si j'aiplusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\actualitesManager;




class actualitesController extends AbstractController implements ControllerInterface {

    public function index()
    {
        // Instanciez le GalerieManager
        $actualitesManager = new actualitesManager();

        // Récupérez les images
        $publications = $actualitesManager->findAll();; 
        // Transmettez les données à la vue
        return [
            "view" => VIEW_DIR . "actualites/actualites.php",
            "meta_description" => "accueil",
            "data" => [
                "publications" => $publications,
            ]
        ];
    }
}