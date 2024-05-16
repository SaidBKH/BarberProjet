<?php
namespace Controller;
// definition require definition  namespace 
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\ClientManager;
use Model\Entities\Client;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register() {

        $clientManager = new ClientManager();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
            $confirmPassword = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_SPECIAL_CHARS); 
            $telephone = filter_input(INPUT_POST, "telephone", FILTER_SANITIZE_SPECIAL_CHARS);   
            
            
         //La fonction PHP preg_match() va nous permettre de rechercher des motifs bien précis au sein d’une chaîne de caractères.
            if (!preg_match("/^.{12,}$/", $password)) {
                echo "Le mot de passe doit contenir au moins 12 caractères.";
                $this->redirectTo("security","register");
             }
            //var_dump($prenom, $email, $password, $confirmPassword && $telephone);die;
            if($prenom && $email && $password && $confirmPassword && $telephone) {
        
                if ($clientManager->emailExist($email)) {
                    echo "l'email existe deja";
                    $this->redirectTo("security","register");
                }
                
                // si les mots de passe correspondent 
                if ($password == $confirmPassword) {
                
                    $clientManager->add([
                            "prenom" => $prenom,
                            "email" => $email,
                            "password" => password_hash($password, PASSWORD_DEFAULT), 
                            "telephone" => $telephone,
                            // password_hash — Crée une clé de hachage pour un mot de passe
                        // PASSWORD_DEFAULT - Utilisation de l'algorithme bcrypt (par défaut depuis PHP 5.5.0).
                            "role" => "Utilisateur"
                    ]);

                    //var_dump($prenom, $email, $password, $confirmPassword && $telephone);die;

                    $this->redirectTo("security", "register");
                }
            } 
        }
        return ["view" => VIEW_DIR . "security/register.php",
        "meta_description" => "Formulaire d'inscription"
   ];


    }


    public function login() {
        $clientManager = new ClientManager();
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

            if ($email && $password) {
                // Vérifier si l'email existe 

                if ($clientManager->emailExist($email)) {

                    // Récupérer l'user grace à l'e-mail
                    $user = $clientManager->findByEmail($email);
                    

                    // Vérifie mdp 
                    if ($user && password_verify($password, $user->getPassword())) {
                        $_SESSION['client'] = $user;
                        $this->redirectTo("home", "index");
                    } else {
                        echo "Mot de passe incorrect";
                        $this->redirectTo("home", "index");
                    }
                } else {
                    echo "L'email n'existe pas";
                        $this->redirectTo("home", "index");

                }
            } 
        }
        return ["view" => VIEW_DIR . "security/login.php",
         "meta_description" => "Formulaire de connexion"
    ];

    }

    public function logout() {
        $_SESSION[] = session_unset();

        $this->redirectTo("home", "index");
        
    }

    public function profil() {
        return [
            "view" => VIEW_DIR."security/profil.php",
            "meta_description" => "page d'accueil",
            "data" => [  

            ]
        ];


        
    }

    
    
    

    



}