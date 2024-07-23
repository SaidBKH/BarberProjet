<?php
namespace App;

// Une classe abstraite qui sert de base pour d'autres classes
abstract class Manager{

    // Une fonction pour se connecter à la base de données
    protected function connect(){
        DAO::connect();
    }

    /**
     * Obtenir tous les enregistrements d'une table, triés par un champ optionnel et un ordre optionnel
     * 
     * @param array $order un tableau avec le champ et l'ordre de tri
     * @return Collection une collection d'objets hydratés par DAO, qui sont les résultats de la requête envoyée
     */
    public function findAll($order = null){

        // Construire la partie de la requête pour le tri si nécessaire
        $orderQuery = ($order) ?                 
            "ORDER BY ".$order[0]. " ".$order[1] :
            "";

        // La requête SQL pour obtenir tous les enregistrements
        $sql = "SELECT *
                FROM ".$this->tableName." a
                ".$orderQuery;
                
        // Retourner les résultats de la requête
        return $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }
    
    // Obtenir un enregistrement par son identifiant
    public function findOneById($id){

        // La requête SQL pour obtenir un enregistrement par son identifiant
        $sql = "SELECT *
                FROM ".$this->tableName." a
                WHERE a.id_".$this->tableName." = :id
                ";

        // Retourner le résultat de la requête
        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id], false), 
            $this->className
        );
    }

    // Ajouter un nouvel enregistrement
    public function add($data){
        // Obtenir les noms des colonnes
        $keys = array_keys($data);
        // Obtenir les valeurs des colonnes
        $values = array_values($data);
        // Construire la requête SQL pour insérer un nouvel enregistrement
        $sql = "INSERT INTO ".$this->tableName."
                (".implode(',', $keys).") 
                VALUES
                ('".implode("','",$values)."')";
        /*
            Par exemple :
            INSERT INTO user (username,password,email) VALUES ('Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com') 
        */
        try{
            // Insérer l'enregistrement et retourner le résultat
            return DAO::insert($sql);
        }
        catch(\PDOException $e){
            // Afficher une erreur s'il y en a
            echo $e->getMessage();
            die();
        }
    }
    
    // Supprimer un enregistrement par son identifiant
    public function delete($id){
        // La requête SQL pour supprimer un enregistrement
        $sql = "DELETE FROM ".$this->tableName."
                WHERE id_".$this->tableName." = :id
                ";

        // Retourner le résultat de la suppression
        return DAO::delete($sql, ['id' => $id]); 
    }

    // Générer des objets à partir des résultats de la requête
    private function generate($rows, $class){
        foreach($rows as $row){
            yield new $class($row);
        }
    }
    
    // Obtenir plusieurs résultats
    protected function getMultipleResults($rows, $class){

        if(is_iterable($rows)){
            return $this->generate($rows, $class);
        }
        else return null;
    }

    // Obtenir un résultat ou null
    protected function getOneOrNullResult($row, $class){

        if($row != null){
            return new $class($row);
        }
        return false;
    }

    // Obtenir une seule valeur
    protected function getSingleScalarResult($row){

        if($row != null){
            $value = array_values($row);
            return $value[0];
        }
        return false;
    }

    // Compter le nombre d'éléments
    public function countElem() {
        $sql = 
        "SELECT
            COUNT(a.id_".$this->tableName.") AS ReCount
        FROM 
            ".$this->tableName." a
        ";

        return $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }

    // Afficher un message
    public function displayMessage($message) {
        echo "<div class='message'>$message</div>";
    }

    // Formater une date en français
    public static function formaterDateEnFrancais($date) {
        // Convertir la date en objet DateTime
        $dateTime = new \DateTime($date); 
    
        // Formater la date en français
        $mois = [
            1 => 'janvier', 2 => 'février', 3 => 'mars', 4 => 'avril',
            5 => 'mai', 6 => 'juin', 7 => 'juillet', 8 => 'août',
            9 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'décembre'
        ];
        $jourSemaine = [
            'dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'
        ];
        $jour = $jourSemaine[$dateTime->format('w')];
        $numJour = $dateTime->format('j');
        $mois = $mois[$dateTime->format('n')];
        $annee = $dateTime->format('Y');
    
        return ucfirst("$jour $numJour $mois $annee");
    }
    
    // Formater seulement le mois en français
    public static function formaterMoisEnFrancais($date) {
        if (!$date) {
            return '';
        }
        
        $dateTime = new \DateTime($date);
        $mois = [
            1 => 'janvier', 2 => 'février', 3 => 'mars', 4 => 'avril',
            5 => 'mai', 6 => 'juin', 7 => 'juillet', 8 => 'août',
            9 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'décembre'
        ];

        $numMois = $dateTime->format('n');

        return $mois[$numMois] ?? '';

    }

    function formatHeure($heure) {
        return date("H:i", strtotime($heure));
    }
}

