<?php
namespace App;  // Cela indique que l'interface que nous allons définir fait partie de l'espace de noms App.


/*
    En programmation orientée objet, une interface est un concept qui permet de définir un contrat comportemental qu'une classe doit suivre. Une interface en POO ne contient que des signatures de méthodes (méthodes sans implémentation), mais ne fournit pas d'implémentation concrète. Elle définit simplement la structure que les classes qui implémentent cette interface doivent respecter.
    Les classes abstraites :
    -- ne peuvent contenir que des signatures de méthodes (méthodes sans implémentation).
    -- ne peuvent pas avoir de propriétés avec des valeurs par défaut (jusqu'à PHP 8.0, où les propriétés peuvent être déclarées, mais sans valeurs par défaut).
    -- une classe peut implémenter plusieurs interfaces.
    -- fournissent une forme de contrat où les classes qui implémentent une interface doivent fournir une implémentation pour toutes les méthodes déclarées dans l'interface.
*/


//Ce interface définit une de règle que les autres classes doivent suivre. ICI elle s'appelle une "interface".
// cette interface ControllerInterface dit à d'autres classes : "Si vous voulez être une un contrôleur vous devez avoir une méthode appelée index()". 
// L'interface ne dit pas ce que la méthode doit faire, juste qu'elle doit exister.



interface ControllerInterface{
    public function index();
}
