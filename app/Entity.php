<?php
namespace App;

abstract class Entity {
    // Cette méthode permet de "hydrater" une entité en utilisant des données fournies.
    protected function hydrate($data) {
        // Parcourt chaque paire clé-valeur dans $data.
        foreach ($data as $field => $value) {
            // Exemple : field = topic_id
            // Divise la clé au niveau du caractère "_" pour obtenir un tableau.
            // Exemple : fieldArray = ['topic', 'id']
            $fieldArray = explode("_", $field);

            // Si le tableau contient un deuxième élément et que cet élément est "id".
            if (isset($fieldArray[1]) && $fieldArray[1] == "id") {
                // Crée le nom du manager en capitalisant le premier élément.
                // Exemple : manName = TopicManager
                $manName = ucfirst($fieldArray[0]) . "Manager";
                // Crée le nom completement qualifié (FQCN) de la classe du manager.
                // Exemple : FQCName = Model\Managers\TopicManager
                $FQCName = "Model\\Managers\\" . $manName;
                
                // Instancie un nouvel objet du manager.
                // Exemple : $man = new Model\Managers\TopicManager()
                $man = new $FQCName();
                // Utilise le manager pour récupérer l'entité correspondant à l'ID donné.
                // Exemple : $value = Model\Managers\TopicManager->findOneById($value)
                $value = $man->findOneById($value);
            }

            // Crée le nom de la méthode "setter" à appeler.
            // Exemple : si $fieldArray[0] = 'name', alors $method = 'setName'
            $method = "set" . ucfirst($fieldArray[0]);
            
            // Vérifie si la méthode existe dans l'entité courante.
            if (method_exists($this, $method)) {
                // Appelle la méthode setter avec la valeur.
                // Exemple : $this->setName("valeur")
                $this->$method($value);
            }
        }
    }

    // Retourne le nom completement qualifié de la classe de l'entité.
    public function getClass() {
        return get_class($this);
    }
}
