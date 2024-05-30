<?php
namespace Controller;
//Un name space est un espace ou sont  grouper un ensemble d'éléments, le but est d'eviter les conflits de noms,
//si j'ai plusieurs fichiers portant le même nom, tant qu'ils se trouvent dans des sous-dossiers différents, ils ne se confondront pas

use App\AbstractController;
use App\ControllerInterface;




class mentionsController extends AbstractController implements ControllerInterface {



    public function index()
    {
        return [
            "view" => VIEW_DIR . "mentions/politique_confidentialite.php",
            "meta_description" => "politique de confidentialité du site",
            "data" => [
               
            ]
        ];
    }

    public function mentionLegal()
    {
        return [
            "view" => VIEW_DIR . "mentions/mention_legal.php",
            "meta_description" => "politique de confidentialité du site",
            "data" => [
               
            ]
        ];
    }

    }