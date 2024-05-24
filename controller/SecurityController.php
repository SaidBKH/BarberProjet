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

            // Récupérer les données du formulaire
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
            $confirmPassword = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_SPECIAL_CHARS); 
            $telephone = filter_input(INPUT_POST, "telephone", FILTER_SANITIZE_SPECIAL_CHARS);

                        
            /*
            PARTIE CAPTCHA 

            // Valider reCAPTCHA
            $recaptchaResponse = $_POST['g-recaptcha-response'];
            $recaptchaSecret = 'YOUR_SECRET_KEY';
            $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptchaData = [
                'secret' => $recaptchaSecret,
                'response' => $recaptchaResponse,
                'remoteip' => $_SERVER['REMOTE_ADDR']
            ];
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => http_build_query($recaptchaData)
                ]
            ];
            $context = stream_context_create($options);
            $recaptchaVerify = file_get_contents($recaptchaUrl, false, $context);
            $recaptchaSuccess = json_decode($recaptchaVerify);
    
            if (!$recaptchaSuccess->success) {
                echo "Veuillez compléter le reCAPTCHA.";
                $this->redirectTo("security", "login");
                return;
            }
            */

            // Valider la force du mot de passe
            if (!preg_match("/^.{12,}$/", $password)) {
                $this->setFlashMessage("Le mot de passe doit contenir au moins 12 caractères.");
                $this->redirectTo("security", "register");
                return;
            }

            // Valider le numéro de téléphone (regex simplifiée pour les exemples)
            if (!preg_match("/^\+?[1-9]\d{1,14}$/", $telephone)) {
                $this->setFlashMessage("Veuillez entrer un numéro de téléphone valide.");
                $this->redirectTo("security", "register");
                return;
            }

            if ($prenom && $email && $password && $confirmPassword && $telephone) {
                if ($clientManager->emailExist($email)) {
                    $this->setFlashMessage("L'email existe déjà.");
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

                    $this->setFlashMessage("Inscription réussie. Vous pouvez maintenant vous connecter.");
                    $this->redirectTo("security", "login");
                    return;
                } else {
                    $this->setFlashMessage("Les mots de passe ne correspondent pas.");
                    $this->redirectTo("security", "register");
                    return;
                }
            } else {
                $this->setFlashMessage("Veuillez remplir tous les champs.");
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
    
            
            /*
            PARTIE CAPTCHA 

            // Valider reCAPTCHA
            $recaptchaResponse = $_POST['g-recaptcha-response'];
            $recaptchaSecret = 'YOUR_SECRET_KEY';
            $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptchaData = [
                'secret' => $recaptchaSecret,
                'response' => $recaptchaResponse,
                'remoteip' => $_SERVER['REMOTE_ADDR']
            ];
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => http_build_query($recaptchaData)
                ]
            ];
            $context = stream_context_create($options);
            $recaptchaVerify = file_get_contents($recaptchaUrl, false, $context);
            $recaptchaSuccess = json_decode($recaptchaVerify);
    
            if (!$recaptchaSuccess->success) {
                echo "Veuillez compléter le reCAPTCHA.";
                $this->redirectTo("security", "login");
                return;
            }
            */
    
            if ($email && $password) {
                if ($clientManager->emailExist($email)) {
                    $user = $clientManager->findByEmail($email);
    
                    if ($user && password_verify($password, $user->getPassword())) {
                        $_SESSION['client'] = $user;
                        
                        // Vérifier si l'utilisateur est un administrateur
                        if (Session::isAdmin()) {
                            // Rediriger vers la page d'administration
                            header('Location: index.php?ctrl=admin&action=index');
                            exit();
                        } else {
                            // Rediriger vers la page par défaut après la connexion
                            header('Location: index.php?ctrl=security&action=profil');
                            exit();
                        }
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

    public function requestReset() {
        $clientManager = new ClientManager();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            
            if ($email) {
                $client = $clientManager->findByEmail($email);
                if ($client) {
                    $token = bin2hex(random_bytes(16)); // Générer un token sécurisé
                    $clientManager->updateProfile($client->getId(), ['resetToken' => $token]);
    
                    // Envoyer l'email de réinitialisation
                    $resetLink = "http://http://localhost:8888/BarberProjet/index.php?ctrl=security&action=request-password";
                    $subject = "Réinitialisation de votre mot de passe";
                    $message = "Cliquez sur le lien suivant pour réinitialiser votre mot de passe : $resetLink";
                    mail($email, $subject, $message);
    
                    $this->setFlashMessage("Un email de réinitialisation de mot de passe a été envoyé.");
                    $this->redirectTo("security", "login");
                    return;
                } else {
                    $this->setFlashMessage("L'email n'existe pas.");
                    $this->redirectTo("security", "requestReset");
                    return;
                }
            } else {
                $this->setFlashMessage("Veuillez entrer un email valide.");
                $this->redirectTo("security", "requestReset");
                return;
            }
        }
    
        return [
            "view" => VIEW_DIR . "security/request_reset.php",
            "meta_description" => "Demande de réinitialisation de mot de passe"
        ];
    }

    
    public function resetPassword() {
        $clientManager = new ClientManager();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = filter_input(INPUT_POST, "token", FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
            $confirmPassword = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_SPECIAL_CHARS);
    
            if ($token && $password && $confirmPassword) {
                if ($password === $confirmPassword) {
                    if (preg_match("/^.{12,}$/", $password)) {
                        $client = $clientManager->findByResetToken($token);
                        if ($client) {
                            $clientManager->updatePassword($client->getId(), password_hash($password, PASSWORD_DEFAULT));
                            $clientManager->updateProfile($client->getId(), ['resetToken' => null]); // Effacer le token après utilisation
                            
                            $this->setFlashMessage("Mot de passe mis à jour avec succès.");
                            $this->redirectTo("security", "login");
                            return;
                        } else {
                            $this->setFlashMessage("Token invalide.");
                            $this->redirectTo("security", "request_reset");
                            return;
                        }
                    } else {
                        $this->setFlashMessage("Le mot de passe doit contenir au moins 12 caractères.");
                        $this->redirectTo("security", "reset_password", ['token' => $token]);
                        return;
                    }
                } else {
                    $this->setFlashMessage("Les mots de passe ne correspondent pas.");
                    $this->redirectTo("security", "reset_password", ['token' => $token]);
                    return;
                }
            } else {
                $this->setFlashMessage("Veuillez remplir tous les champs.");
                $this->redirectTo("security", "reset_Password", ['token' => $token]);
                return;
            }
        }
    
        return [
            "view" => VIEW_DIR . "security/reset_password.php",
            "meta_description" => "Réinitialiser votre mot de passe"
        ];
    }
    
    

}

    
    
    

    


