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

            PARTIE CAPTCHA GOOGLE API

                // Valider reCAPTCHA

                $recaptchaResponse = $_POST['g-recaptcha-response']; // Récupération de la réponse reCAPTCHA depuis le formulaire
                $recaptchaSecret = 'YOUR_SECRET_KEY'; // Clé secrète reCAPTCHA
                $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify'; // URL de l'API reCAPTCHA
                $recaptchaData = [
                    'secret' => $recaptchaSecret, // Clé secrète dans les données envoyées à l'API
                    'response' => $recaptchaResponse, // Réponse reCAPTCHA dans les données envoyées à l'API
                    'remoteip' => $_SERVER['REMOTE_ADDR'] // Adresse IP de l'utilisateur dans les données envoyées à l'API
                ];
                $options = [
                    'http' => [
                        'method' => 'POST', // Méthode HTTP utilisée pour la requête
                        'header' => 'Content-Type: application/x-www-form-urlencoded', // Type de contenu de la requête
                        'content' => http_build_query($recaptchaData) // Données envoyées dans le corps de la requête
                    ]
                ];
                $context = stream_context_create($options); // Création du contexte pour la requête HTTP
                $recaptchaVerify = file_get_contents($recaptchaUrl, false, $context); // Envoi de la requête et récupération de la réponse
                $recaptchaSuccess = json_decode($recaptchaVerify); // Décodage de la réponse JSON en objet PHP

                if (!$recaptchaSuccess->success) {
                    // Si la vérification reCAPTCHA échoue, affiche un message et redirige
                    echo "Veuillez compléter le reCAPTCHA."; // Affichage d'un message d'erreur
                    $this->redirectTo("security", "register"); // Redirection vers la page d'inscription
                    return; // Arrêt de l'exécution du code
                }
                */




    
            // Valider la force du mot de passe
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

    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            
            if ($email) {
                $clientManager = new ClientManager();
                $user = $clientManager->findByEmail($email);
                
                if ($user) {
                    // Générer un jeton unique
                    $token = bin2hex(random_bytes(32));
                    
                    // Stocker le jeton dans la base de données
                    $clientManager->setResetToken($user->getId(), $token);
                    
                    // Envoyer un e-mail à l'utilisateur avec un lien de réinitialisation contenant le jeton
                    $resetLink = "http://localhost:8888/BarberProjet/reset_password.php?token=$token";
                    $subject = "Réinitialisation de mot de passe";
                    $message = "Bonjour,\n\nPour réinitialiser votre mot de passe, veuillez cliquer sur le lien suivant : $resetLink";
                    
                    // Envoie de l'e-mail (non implémenté pour l'exercice)
                    // mail($email, $subject, $message);
    
                    echo "Un e-mail de réinitialisation a été envoyé à votre adresse.";
                    return;
                } else {
                    echo "Aucun utilisateur trouvé avec cette adresse e-mail.";
                    return;
                }
            } else {
                echo "Veuillez saisir une adresse e-mail valide.";
                return;
            }
        }
        
        return [
            "view" => VIEW_DIR . "security/forgot_password.php",
            "meta_description" => "Mot de passe oublié"
        ];
    }
    




}

    
    
    

    


