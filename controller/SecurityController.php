<?php
namespace Controller;
// definition require definition  namespace 
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\PostManager;

use Model\Entities\User;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

   // public function register () {}
  //  public function login () {}
  //  public function logout () {}

    public function registerForm() {
        return [
            "view" => VIEW_DIR . "security/registerForm.php",
            "meta_description" => "Formulaire d'inscription"
        ];
    }

    public function register() {

        $userManager = new UserManager();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nickName = filter_input(INPUT_POST, "nickName", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
            $confirmPassword = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_SPECIAL_CHARS);             
         //La fonction PHP preg_match() va nous permettre de rechercher des motifs bien précis au sein d’une chaîne de caractères.
            if (!preg_match("/^.{12,}$/", $password)) {
                echo "Le mot de passe doit contenir au moins 12 caractères.";
                $this->redirectTo("home","index");
             }


            //var_dump($nickName, $email, $password, $confirmPassword);
            if($nickName && $email && $password && $confirmPassword) {
        
                if ($userManager->emailExist($email)) {
                    echo "l'email existe deja";
                    $this->redirectTo("home","index");
                }
                
                // si les mots de passe correspondent 
                if ($password == $confirmPassword) {
                
                    $userManager->add([
                            "nickname" => $nickName,
                            "email" => $email,
                            "password" => password_hash($password, PASSWORD_DEFAULT), 
                            // password_hash — Crée une clé de hachage pour un mot de passe
                        // PASSWORD_DEFAULT - Utilisation de l'algorithme bcrypt (par défaut depuis PHP 5.5.0).
                            "role" => "Utilisateur"
                    ]);
                    $this->redirectTo("home", "index");
                }
            } 
        }
    }

    public function loginForm() {
        return [
            "view" => VIEW_DIR . "security/loginForm.php",
            "meta_description" => "Formulaire de connexion"
        ];
    }

    public function login() {
        $userManager = new UserManager();
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

            if ($email && $password) {
                // Vérifier si l'email existe 

                if ($userManager->emailExist($email)) {

                    // Récupérer l'user grace à l'e-mail
                    $user = $userManager->findByEmail($email);
                    //var_dump($user);die;

                    // Vérifie mdp 
                    if ($user && password_verify($password, $user->getPassword())) {
                        $_SESSION['user'] = $user;
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


}