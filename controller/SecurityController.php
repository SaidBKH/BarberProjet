<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\ClientManager;
use Model\Managers\ReservationManager;
use App\Session;

class SecurityController extends AbstractController {

    // Méthode pour gérer l'inscription des utilisateurs
    public function register() {
        $clientManager = new ClientManager(); // Crée une instance de ClientManager pour gérer les clients

        // Vérifie si la requête est une requête POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Récupère et nettoie les données du formulaire
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS); // Nettoie le prénom
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL); // Valide et nettoie l'email
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS); // Nettoie le mot de passe
            $confirmPassword = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_SPECIAL_CHARS); // Nettoie la confirmation du mot de passe
            $telephone = filter_input(INPUT_POST, "telephone", FILTER_SANITIZE_SPECIAL_CHARS); // Nettoie le numéro de téléphone

            /*
            PARTIE CAPTCHA (commentée pour l'instant)
            // Valide le reCAPTCHA pour éviter les soumissions automatisées
            $recaptchaResponse = $_POST['g-recaptcha-response'];
            $recaptchaSecret = 'YOUR_SECRET_KEY'; // Remplacer par votre clé secrète reCAPTCHA
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

            // Valide que le mot de passe a au moins 12 caractères
            if (!preg_match("/^.{12,}$/", $password)) {
                $this->setFlashMessage("Le mot de passe doit contenir au moins 12 caractères.");
                $this->redirectTo("security", "register");
                return;
            }

            // Valide le format du numéro de téléphone (simple regex pour l'exemple)
            if (!preg_match("/^\+?[1-9]\d{1,14}$/", $telephone)) {
                $this->setFlashMessage("Veuillez entrer un numéro de téléphone valide.");
                $this->redirectTo("security", "register");
                return;
            }

            // Vérifie si tous les champs requis sont remplis
            if ($prenom && $email && $password && $confirmPassword && $telephone) {
                // Vérifie si l'email existe déjà dans la base de données
                if ($clientManager->emailExist($email)) {
                    $this->setFlashMessage("L'email existe déjà.");
                    $this->redirectTo("security", "register");
                    return;
                }

                // Vérifie si les mots de passe correspondent
                if ($password === $confirmPassword) {
                    // Ajoute le nouveau client dans la base de données
                    $clientManager->add([
                        "prenom" => $prenom,
                        "email" => $email,
                        "password" => password_hash($password, PASSWORD_DEFAULT), // Hache le mot de passe avant de le stocker
                        "telephone" => $telephone,
                        "role" => "Utilisateur" // Définit le rôle par défaut de l'utilisateur
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

        // Retourne les paramètres pour la vue d'inscription
        return [
            "view" => VIEW_DIR . "security/register.php", // Chemin vers la vue d'inscription
            "meta_description" => "Formulaire d'inscription" // Description méta pour la page d'inscription
        ];
    }

    // Méthode pour gérer la connexion des utilisateurs
    public function login() {
        $clientManager = new ClientManager(); // Crée une instance de ClientManager pour gérer les clients

        // Vérifie si la requête est une requête POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL); // Valide et nettoie l'email
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS); // Nettoie le mot de passe

            /*
            PARTIE CAPTCHA (commentée pour l'instant)
            // Valide le reCAPTCHA pour éviter les soumissions automatisées
            $recaptchaResponse = $_POST['g-recaptcha-response'];
            $recaptchaSecret = 'YOUR_SECRET_KEY'; // Remplacer par votre clé secrète reCAPTCHA
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
    
            // Vérifie si l'email et le mot de passe sont fournis
            if ($email && $password) {
                // Vérifie si l'email existe dans la base de données
                if ($clientManager->emailExist($email)) {
                    $user = $clientManager->findByEmail($email); // Récupère l'utilisateur correspondant à l'email

                    // Vérifie si le mot de passe est correct
                    if ($user && password_verify($password, $user->getPassword())) {
                        $_SESSION['client'] = $user; // Stocke l'utilisateur dans la session
                        
                        // Vérifie si l'utilisateur est un administrateur
                        if (Session::isAdmin()) {
                            // Redirige vers la page d'administration
                            header('Location: index.php?ctrl=admin&action=index');
                            exit();
                        } else {
                            // Redirige vers la page de profil de l'utilisateur
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

        // Retourne les paramètres pour la vue de connexion
        return [
            "view" => VIEW_DIR . "security/login.php", // Chemin vers la vue de connexion
            "meta_description" => "Formulaire de connexion" // Description méta pour la page de connexion
        ];
    }

    // Méthode pour déconnecter l'utilisateur
    public function logout() {
        session_unset(); // Efface toutes les variables de session
        session_destroy(); // Détruit la session
        $this->redirectTo("home", "index"); // Redirige vers la page d'accueil
    }

    // Méthode pour afficher le profil de l'utilisateur
    public function profil() {
        $reservationManager = new ReservationManager(); // Crée une instance de ReservationManager pour gérer les réservations
        $clientId = \App\Session::getUser()->getId(); // Récupère l'ID de l'utilisateur connecté
        $reservations = $reservationManager->ReservationsByClient($clientId); // Récupère les réservations de l'utilisateur
        
        // Retourne les paramètres pour la vue de profil
        return [
            "view" => VIEW_DIR . "security/profil.php", // Chemin vers la vue du profil
            "meta_description" => "page d'accueil", // Description méta pour la page de profil
            "data" => [
                "reservations" => $reservations // Passe les réservations à la vue
            ]
        ];
    }

    // Méthode pour éditer le profil de l'utilisateur
    public function editProfile() {
        $clientManager = new ClientManager(); // Crée une instance de ClientManager pour gérer les clients
        $client = Session::getUser(); // Récupère l'utilisateur connecté
    
        // Vérifie si la requête est une requête POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); // Valide et nettoie l'email
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS); // Nettoie le prénom
            $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_SPECIAL_CHARS); // Nettoie le numéro de téléphone
    
            // Vérifie si tous les champs requis sont remplis
            if ($email && $prenom && $telephone) {
                // Vérifie si l'email n'existe pas déjà ou est l'email actuel de l'utilisateur
                if (!$clientManager->emailExist($email) || $email === $client->getEmail()) {
                    // Met à jour le profil de l'utilisateur
                    $clientManager->updateProfile($client->getId(), [
                        'email' => $email,
                        'prenom' => $prenom,
                        'telephone' => $telephone
                    ]);
    
                    // Met à jour les informations de l'utilisateur dans la session
                    $client->setEmail($email);
                    $client->setPrenom($prenom);
                    $client->setTelephone($telephone);
                    Session::setUser($client);
                    
                    $this->redirectTo('security', 'profil'); // Redirige vers la page de profil
                } else {
                    echo "L'email existe déjà";
                }
            }
        }
    
        // Retourne les paramètres pour la vue de modification du profil
        return [
            "view" => VIEW_DIR . "security/editProfile.php", // Chemin vers la vue de modification du profil
            "meta_description" => "Modification du profil" // Description méta pour la page de modification du profil
        ];
    }

    // Méthode pour modifier le mot de passe de l'utilisateur
    public function editPassword() {
        $clientManager = new ClientManager(); // Crée une instance de ClientManager pour gérer les clients
        
        // Vérifie si la requête est une requête POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oldPassword = filter_input(INPUT_POST, "old_password", FILTER_SANITIZE_SPECIAL_CHARS); // Nettoie l'ancien mot de passe
            $newPassword = filter_input(INPUT_POST, "new_password", FILTER_SANITIZE_SPECIAL_CHARS); // Nettoie le nouveau mot de passe
            $confirmNewPassword = filter_input(INPUT_POST, "confirm_new_password", FILTER_SANITIZE_SPECIAL_CHARS); // Nettoie la confirmation du nouveau mot de passe
    
            // Vérifie si tous les champs requis sont remplis
            if ($oldPassword && $newPassword && $confirmNewPassword) {
                $user = \App\Session::getUser(); // Récupère l'utilisateur connecté
    
                // Vérifie si l'ancien mot de passe est correct
                if (password_verify($oldPassword, $user->getPassword())) {
                    // Vérifie si les nouveaux mots de passe correspondent
                    if ($newPassword === $confirmNewPassword) {
                        // Vérifie que le nouveau mot de passe a au moins 12 caractères
                        if (preg_match("/^.{12,}$/", $newPassword)) {
                            // Met à jour le mot de passe de l'utilisateur
                            $clientManager->updatePassword($user->getId(), password_hash($newPassword, PASSWORD_DEFAULT));
                            echo "Mot de passe mis à jour avec succès.";
                            $this->redirectTo("security", "profil"); // Redirige vers la page de profil
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
    
        // Retourne les paramètres pour la vue de modification du mot de passe
        return [
            "view" => VIEW_DIR . "security/edit_password.php", // Chemin vers la vue de modification du mot de passe
            "meta_description" => "Modifier votre mot de passe" // Description méta pour la page de modification du mot de passe
        ];
    }

    // Méthode pour demander une réinitialisation de mot de passe
    public function requestReset() {
        $clientManager = new ClientManager(); // Crée une instance de ClientManager pour gérer les clients
        
        // Vérifie si la requête est une requête POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL); // Valide et nettoie l'email
            
            // Vérifie si l'email est fourni
            if ($email) {
                $client = $clientManager->findByEmail($email); // Récupère l'utilisateur correspondant à l'email
                if ($client) {
                    $token = bin2hex(random_bytes(16)); // Génère un token sécurisé pour la réinitialisation
                    $clientManager->updateProfile($client->getId(), ['resetToken' => $token]); // Enregistre le token dans la base de données
    
                    // Envoie l'email de réinitialisation
                    $resetLink = "http://http://localhost:8888/BarberProjet/index.php?ctrl=security&action=request-password";
                    $subject = "Réinitialisation de votre mot de passe";
                    $message = "Cliquez sur le lien suivant pour réinitialiser votre mot de passe : $resetLink";
                    mail($email, $subject, $message); // Envoie l'email
    
                    $this->setFlashMessage("Un email de réinitialisation de mot de passe a été envoyé.");
                    $this->redirectTo("security", "login"); // Redirige vers la page de connexion
                    return;
                } else {
                    $this->setFlashMessage("L'email n'existe pas.");
                    $this->redirectTo("security", "requestReset"); // Redirige vers la page de demande de réinitialisation
                    return;
                }
            } else {
                $this->setFlashMessage("Veuillez entrer un email valide.");
                $this->redirectTo("security", "requestReset"); // Redirige vers la page de demande de réinitialisation
                return;
            }
        }
    
        // Retourne les paramètres pour la vue de demande de réinitialisation de mot de passe
        return [
            "view" => VIEW_DIR . "security/request_reset.php", // Chemin vers la vue de demande de réinitialisation
            "meta_description" => "Demande de réinitialisation de mot de passe" // Description méta pour la page de demande de réinitialisation
        ];
    }

    // Méthode pour réinitialiser le mot de passe de l'utilisateur
    public function resetPassword() {
        $clientManager = new ClientManager(); // Crée une instance de ClientManager pour gérer les clients
        
        // Vérifie si la requête est une requête POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = filter_input(INPUT_POST, "token", FILTER_SANITIZE_SPECIAL_CHARS); // Nettoie le token
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS); // Nettoie le mot de passe
            $confirmPassword = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_SPECIAL_CHARS); // Nettoie la confirmation du mot de passe
    
            // Vérifie si tous les champs requis sont remplis
            if ($token && $password && $confirmPassword) {
                // Vérifie si les mots de passe correspondent
                if ($password === $confirmPassword) {
                    // Vérifie que le mot de passe a au moins 12 caractères
                    if (preg_match("/^.{12,}$/", $password)) {
                        $client = $clientManager->findByResetToken($token); // Récupère l'utilisateur correspondant au token
                        if ($client) {
                            // Met à jour le mot de passe de l'utilisateur
                            $clientManager->updatePassword($client->getId(), password_hash($password, PASSWORD_DEFAULT));
                            $clientManager->updateProfile($client->getId(), ['resetToken' => null]); // Efface le token après utilisation
                            
                            $this->setFlashMessage("Mot de passe mis à jour avec succès.");
                            $this->redirectTo("security", "login"); // Redirige vers la page de connexion
                            return;
                        } else {
                            $this->setFlashMessage("Token invalide.");
                            $this->redirectTo("security", "request_reset"); // Redirige vers la page de demande de réinitialisation
                            return;
                        }
                    } else {
                        $this->setFlashMessage("Le mot de passe doit contenir au moins 12 caractères.");
                        $this->redirectTo("security", "reset_password", ['token' => $token]); // Redirige vers la page de réinitialisation du mot de passe
                        return;
                    }
                } else {
                    $this->setFlashMessage("Les mots de passe ne correspondent pas.");
                    $this->redirectTo("security", "reset_password", ['token' => $token]); // Redirige vers la page de réinitialisation du mot de passe
                    return;
                }
            } else {
                $this->setFlashMessage("Veuillez remplir tous les champs.");
                $this->redirectTo("security", "reset_password", ['token' => $token]); // Redirige vers la page de réinitialisation du mot de passe
                return;
            }
        }
    
        // Retourne les paramètres pour la vue de réinitialisation du mot de passe
        return [
            "view" => VIEW_DIR . "security/reset_password.php", // Chemin vers la vue de réinitialisation
            "meta_description" => "Réinitialiser votre mot de passe" // Description méta pour la page de réinitialisation
        ];
    }

    // Méthode pour supprimer le compte de l'utilisateur
    public function deleteAccount() {
        $user = Session::getUser(); // Vérifie que l'utilisateur est connecté
        if (!$user) {
            $this->setFlashMessage('error', 'Vous devez être connecté pour supprimer un compte.'); // Message d'erreur si non connecté
            $this->redirectTo('security', 'login'); // Redirige vers la page de connexion
            return;
        }

        $clientId = $user->getId(); // Récupère l'ID de l'utilisateur connecté

        $clientManager = new ClientManager(); // Crée une instance de ClientManager pour gérer les clients
        $result = $clientManager->deleteClient($clientId); // Supprime le compte de l'utilisateur

        if ($result) {
            SecurityController::logout(); // Déconnecte l'utilisateur après la suppression
            $this->setFlashMessage('success', 'Votre compte a été supprimé avec succès.'); // Message de succès
            $this->redirectTo('home', 'index'); // Redirige vers la page d'accueil
        } else {
            $this->setFlashMessage('error', 'Une erreur est survenue lors de la suppression de votre compte.'); // Message d'erreur si la suppression échoue
            $this->redirectTo('security', 'profil'); // Redirige vers la page de profil
        }
    }
}
