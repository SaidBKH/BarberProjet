<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\ClientManager;
use Model\Managers\ReservationManager;
use App\Session;




class SecurityController extends AbstractController {

    public function register() {
        $clientManager = new ClientManager();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
            $confirmPassword = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_SPECIAL_CHARS); 
            $telephone = filter_input(INPUT_POST, "telephone", FILTER_SANITIZE_SPECIAL_CHARS);   

            // Validate password strength
            if (!preg_match("/^.{12,}$/", $password)) {
                echo "Le mot de passe doit contenir au moins 12 caractères.";
                $this->redirectTo("security", "register");
                return;
            }

            if ($prenom && $email && $password && $confirmPassword && $telephone) {
                if ($clientManager->emailExist($email)) {
                    echo "L'email existe déjà.";
                    $this->redirectTo("security", "register");
                    return;
                }

                if ($password === $confirmPassword) {
                    $clientManager->add([
                        "prenom" => $prenom,
                        "email" => $email,
                        "password" => password_hash($password, PASSWORD_DEFAULT), 
                        "telephone" => $telephone,
                        "role" => "Utilisateur"
                    ]);

                    echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
                    $this->redirectTo("security", "login");
                    return;
                } else {
                    echo "Les mots de passe ne correspondent pas.";
                    $this->redirectTo("security", "register");
                    return;
                }
            } else {
                echo "Veuillez remplir tous les champs.";
                $this->redirectTo("security", "register");
                return;
            }
        }

        return [
            "view" => VIEW_DIR . "security/register.php",
            "meta_description" => "Formulaire d'inscription"
        ];
    }

    public function login() {
        $clientManager = new ClientManager();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

            if ($email && $password) {
                if ($clientManager->emailExist($email)) {
                    $user = $clientManager->findByEmail($email);

                    if ($user && password_verify($password, $user->getPassword())) {
                        $_SESSION['client'] = $user;
                        $this->redirectTo("home", "index");
                        return;
                    } else {
                        echo "Mot de passe incorrect.";
                        $this->redirectTo("security", "login");
                        return;
                    }
                } else {
                    echo "L'email n'existe pas.";
                    $this->redirectTo("security", "login");
                    return;
                }
            } else {
                echo "Veuillez remplir tous les champs.";
                $this->redirectTo("security", "login");
                return;
            }
        }

        return [
            "view" => VIEW_DIR . "security/login.php",
            "meta_description" => "Formulaire de connexion"
        ];
    }

    public function logout() {
        session_unset();
        session_destroy();
        $this->redirectTo("home", "index");
    }
    




        public function profil() {
            $reservationManager = new ReservationManager;
            $clientId = \App\Session::getUser()->getId();
            $reservations = $reservationManager->ReservationsByClient($clientId);
        
            return [
                "view" => VIEW_DIR."security/profil.php",
                "meta_description" => "page d'accueil",
                "data" => [  
                    "reservations" => $reservations
                ]
            ];
        }
        

        public function editProfile() {
            $clientManager = new ClientManager();
            $client = Session::getUser();
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
                $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_SPECIAL_CHARS);
    
                if ($email && $prenom && $telephone) {
                    if (!$clientManager->emailExist($email) || $email === $client->getEmail()) {
                        $clientManager->updateProfile($client->getId(), [
                            'email' => $email,
                            'prenom' => $prenom,
                            'telephone' => $telephone
                        ]);
    
                        $client->setEmail($email);
                        $client->setPrenom($prenom);
                        $client->setTelephone($telephone);
                        Session::setUser($client);
                        
                        $this->redirectTo('security', 'profil');
                    } else {
                        echo "L'email existe déjà";
                    }
                }
            }
    
            return ["view" => VIEW_DIR . "security/editProfile.php",
                    "meta_description" => "Modification du profil"];
        }


        
        public function editPassword() {
            $clientManager = new ClientManager();
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $oldPassword = filter_input(INPUT_POST, "old_password", FILTER_SANITIZE_SPECIAL_CHARS);
                $newPassword = filter_input(INPUT_POST, "new_password", FILTER_SANITIZE_SPECIAL_CHARS);
                $confirmNewPassword = filter_input(INPUT_POST, "confirm_new_password", FILTER_SANITIZE_SPECIAL_CHARS);
    
                if ($oldPassword && $newPassword && $confirmNewPassword) {
                    $user = \App\Session::getUser();
    
                    if (password_verify($oldPassword, $user->getPassword())) {
                        if ($newPassword === $confirmNewPassword) {
                            if (preg_match("/^.{12,}$/", $newPassword)) {
                                $clientManager->updatePassword($user->getId(), password_hash($newPassword, PASSWORD_DEFAULT));
                                echo "Mot de passe mis à jour avec succès.";
                                $this->redirectTo("security", "profil");
                                return;
                            } else {
                                echo "Le nouveau mot de passe doit contenir au moins 12 caractères.";
                            }
                        } else {
                            echo "Les nouveaux mots de passe ne correspondent pas.";
                        }
                    } else {
                        echo "L'ancien mot de passe est incorrect.";
                    }
                } else {
                    echo "Veuillez remplir tous les champs.";
                }
            }
    
            return [
                "view" => VIEW_DIR . "security/edit_password.php",
                "meta_description" => "Modifier votre mot de passe"
            ];
    }
}

    
    
    

    


