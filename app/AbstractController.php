<?php
namespace App;

/*
    En programmation orientée objet, une classe abstraite est une classe qui ne peut pas être instanciée directement. Cela signifie que vous ne pouvez pas créer un objet directement à partir d'une classe abstraite.
    Les classes abstraites : 
    -- peuvent contenir à la fois des méthodes abstraites (méthodes sans implémentation) et des méthodes concrètes (méthodes avec implémentation).
    -- peuvent avoir des propriétés (variables) avec des valeurs par défaut.
    -- une classe peut étendre une seule classe abstraite.
    -- permettent de fournir une certaine implémentation de base.
*/

// On definit ici la classe abstraite AbstractControlleR

abstract class AbstractController{


// methode index, implémentation de base,  elle doit être remplie avec du code par les classes enfant.
    public function index() {}


    // sur le meme principe que l'index c'est une méthode pour rediriger l'utilisateur vers une autre page
    public function redirectTo($ctrl = null, $action = null, $id = null){

// Construction de l'URL de redirection à partir des paramettres qui sont cités
        $url = $ctrl ? "?ctrl=".$ctrl : "";
        $url.= $action ? "&action=".$action : "";
        $url.= $id ? "&id=".$id : "";

        header("Location: $url");
        die();
    }
}