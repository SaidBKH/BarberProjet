<?php
//classeDAO ( "Data Access Object").  Cette classe nous aide à communiquer avec une base de données. 
// Elle permet d'ajouter, de mettre à jour, de supprimer et de sélectionner des données dans la base de données. 


namespace App;

/**
 * Classe d'accès aux données de la BDD, abstraite
 * 
 * @property static $bdd l'instance de PDO que la classe stockera lorsque connect() sera appelé
 *
 * @method static connect() connexion à la BDD
 * @method static insert() requètes d'insertion dans la BDD
 * @method static select() requètes de sélection
 */
abstract class DAO{

    private static $host   = 'mysql:host=127.0.0.1;port=3306';
    private static $dbname = 'barber2';
    private static $dbuser = 'root';
    private static $dbpass = '';

    private static $bdd;

    /**
     * cette méthode permet de créer l'unique instance de PDO de l'application
     */
    public static function connect(){
        
        self::$bdd = new \PDO(
            self::$host.';dbname='.self::$dbname,
            self::$dbuser,
            self::$dbpass,
            array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            )   
        );
    }

    public static function insert($sql){
        try{
            $stmt = self::$bdd->prepare($sql);
            $stmt->execute();
            //on renvoie l'id de l'enregistrement qui vient d'être ajouté en base, 
            //pour s'en servir aussitôt dans le controleur
            return self::$bdd->lastInsertId();
            
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public static function update($sql, $params){
        try{
            $stmt = self::$bdd->prepare($sql);
        
            //on renvoie l'état du statement après exécution (true ou false)
            return $stmt->execute($params);
            
        }
        catch(\Exception $e){
            
            echo $e->getMessage();
        }
    }
    
    public static function delete($sql, $params){
        try{
            $stmt = self::$bdd->prepare($sql);

            //on renvoie l'état du statement après exécution (true ou false)
            return $stmt->execute($params);
            
        }
        catch(\Exception $e){
            echo $sql;
            echo $e->getMessage();
            die();
        }
    }

    /**
     * Cette méthode permet les requêtes de type SELECT
     * 
     * @param string $sql la chaine de caractère contenant la requête elle-même
     * @param mixed $params=null les paramètres de la requête
     * @param bool $multiple=true vrai si le résultat est composé de plusieurs enregistrements (défaut), false si un seul résultat doit être récupéré
     * 
     * @return array|null les enregistrements en FETCH_ASSOC ou null si aucun résultat
     */
    public static function select($sql, $params = null, bool $multiple = true):?array
    {
        try{
            $stmt = self::$bdd->prepare($sql);
            $stmt->execute($params);
            
            $results = ($multiple) ? $stmt->fetchAll() : $stmt->fetch();

            $stmt->closeCursor();
            return ($results == false) ? null : $results;
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}

    //Ce code concerne une classe appelée DAO (qui signifie "Data Access Object") dans votre application PHP. Cette classe est spéciale car elle nous aide à communiquer avec une base de données. Voici ce que chaque partie du code fait :

//         abstract class DAO{...}: Ici, nous définissons la classe DAO. Mais elle est un peu spéciale car nous avons utilisé le mot clé abstract, ce qui signifie que cette classe ne peut pas être utilisée directement. Elle sert plutôt de modèle pour d'autres classes qui vont l'utiliser.
//         private static $host = 'mysql:host=127.0.0.1;port=3306';: Ces lignes définissent des informations sur la manière de se connecter à une base de données. Cela dit à notre code où se trouve la base de données et comment s'y connecter.
//         private static $bdd;: C'est une variable spéciale qui va contenir notre connexion à la base de données une fois que nous nous serons connectés.
//         public static function connect(){...}: Cette fonction est utilisée pour se connecter à la base de données. Elle utilise les informations de connexion définies plus tôt pour se connecter et stocke cette connexion dans la variable $bdd.
//         public static function insert($sql){...}: Cette fonction est utilisée pour ajouter des données dans la base de données.
//         public static function update($sql, $params){...}: Cette fonction est utilisée pour mettre à jour des données existantes dans la base de données.
//         public static function delete($sql, $params){...}: Cette fonction est utilisée pour supprimer des données de la base de données.
//         public static function select($sql, $params = null, bool $multiple = true):?array{...}: Cette fonction est utilisée pour sélectionner des données dans la base de données. Elle peut également prendre des paramètres pour filtrer les résultats, comme chercher tous les utilisateurs dont le nom est "John".
//         En résumé, cette classe DAO fournit des outils pour communiquer avec une base de données. Elle permet d'ajouter, de mettre à jour, de supprimer et de sélectionner des données dans la base de données. Elle simplifie grandement le travail avec les bases de données dans votre application.
// }


