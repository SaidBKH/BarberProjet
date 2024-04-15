<?php
namespace Controller;
//Un name space est un espace ou sont  grouper un ensemble d'éléments, le but est d'eviter les conflits de noms,
//si j'aiplusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas

use App\AbstractController;
use App\ControllerInterface;


class servicesController extends AbstractController implements ControllerInterface {

    public function index() {
        return [
            "view" => VIEW_DIR."services/nos_services.php",
            "meta_description" => "page d'accueil",
            "data" => [                   
            ]
        ];
    }
   

    }