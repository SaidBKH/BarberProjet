<!DOCTYPE html>   <!-- Indique au navigateur que le document est écrit en HTML-->
<html lang="en"> <!-- Indique au navigateur que le document est écrit en HTML-->
    <head>
        <meta charset="UTF-8">   <!-- Spécifie l'encodage des caractères comme UTF-8.-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configure la vue du port de l'appareil pour s'adapter à la largeur de l'écran.-->
        <meta name="description" content="<?= $meta_description ?>"> <!-- Fournit une description de la page pour les moteurs de recherche, avec une variable PHP pour la valeur.-->
        <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Spécifie la compatibilité avec Edge/Internet Explorer.-->


        <link href='https://unpkg.com/@fullcalendar/core@5.9.0/main.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/daygrid@5.9.0/main.min.css' rel='stylesheet' />
    <script src='https://unpkg.com/@fullcalendar/core@5.9.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid@5.9.0/main.min.js'></script>
    <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap">
 


    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


        <!-- Intègre TinyMCE, un éditeur de texte HTML en ligne.-->
        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
       <!-- Intègre Font Awesome, une bibliothèque d'icônes.-->
       <!-- Inclure Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<!-- Inclure Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>



        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css"> <!--  Lie le fichier CSS de style à la page.-->
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.home.css">

        <title>Jesuispassechezsouf</title>   <!--Définit le titre de la page. --> <!-- -->
    
    </head>
<body>
        <div id="wrapper">  <!-- Conteneur principal de la page.-->
            <div id="mainpage">  <!-- Conteneur principal de la partie visible de la page.-->

                <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
                <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
                
                <header class="header"><!--En-tête de la page. -->
                  <figure>
                 <a href="index.php">  <img src="public/img/logo.png" alt ="logo jesuispassechezsouf"></a>  <!-- le logo---->
                  </figure>
                    <div class="header_mobile" onclick="toggleMenu()"> 
                    <!-- Définition de l'icône pour ouvrir le menu -->
 
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </div>

                    <nav class="bureau">
                                <?php if(App\Session::getUser()): ?> <!--Vérifie si un utilisateur est connecté. -->
                                    
                                    <div class="nav_bureau_profil">
                                        <div class="profil_dropdown">
                                            <button class="profil_button">
                                                <span class="fas fa-user"></span>
                                                <span><?= App\Session::getUser()->getPrenom() ?></span>
                                                <span class="fas fa-caret-down"></span>
                                            </button>
                                            <div class="profil_content">
                                                <a href="index.php?ctrl=security&action=profil">Profil</a>
                                                <a href="index.php?ctrl=security&action=logout">Déconnexion</a>
                                                <?php if(App\Session::isAdmin()): ?>
                                                    <a href="index.php?ctrl=admin&action=tableau_de_bord">Tableau de bord</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>


                                <?php endif; ?>
                                <ul class="nav_bureau_menu">
                                    <li>
                                        <a href="index.php">ACCUEIL</a>
                                   </li> 
                                    <li>
                                        <a href="index.php?ctrl=news&action=news">ACTUALITÉ</a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=reservation&action=listService">RÉSERVATIONS
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=ourServices&action=ourServices">NOS SERVICES</a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=joinUs&action=joinUs">NOUS REJOINDRE</a>
                                    </li>
                                    <li>
                                    <a href="index.php?ctrl=contact&action=contact">CONTACT
                                        </a>
                                    </li>
                                    <?php if(!App\Session::getUser()): ?> <!--Ajouter cette condition pour les utilisateurs non connectés -->
                                        <li>
                                            <a href="index.php?ctrl=security&action=login">
                                                <i class="fas fa-sign-in-alt"></i>CONNEXION
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                        

                    </nav>
                </header>

                    <nav class ="nav_mobile"> <!--nav pour mobile -->

                        <div class="nav_mobile_close" onclick="toggleMenu()"> <!-- Définition de l'icône pour fermer le menu -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </div>
                            <section class="top"> <!--section superieur de la nav -->
                                <?php if(App\Session::getUser()): ?> <!--Vérifie si un utilisateur est connecté. -->
                                    <div class ="nav_mobile_profil">
                                        <a href="index.php?ctrl=security&action=profil">
                                            <span class="fas fa-user"></span>
                                            &nbsp;<?= App\Session::getUser()->getPrenom() ?>
                                        </a>
                                        <a href="index.php?ctrl=security&action=logout">DÉCONNEXION</a>
                                        <?php if(App\Session::isAdmin()): ?>
                                            <a href="index.php?ctrl=admin&action=tableau_de_bord">TABLEAU DE BORD</a>
                                        <?php endif; ?>
                                    </div>
                                    
                                <?php endif; ?>
                                <ul class="nav_mobile_menu">
                                    <li>
                                        <a href="index.php">
                                            <i class="fas fa-home"></i>ACCUEIL
                                        </a>
                                    </li> 
                                    <li>
                                        <a href="index.php?ctrl=news&action=news">
                                            <i class="fas fa-newspaper"></i>ACTUALITÉ
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=reservation&action=listService">
                                            <i class="fas fa-calendar-check"></i>RÉSERVATION
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=ourServices&action=ourServices">
                                            <i class="fas fa-toolbox"></i>NOS SERVICES
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=joinUs&action=joinUs">
                                            <i class="fas fa-users"></i>NOUS REJOINDRE
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=contact&action=contact">
                                            <i class="fas fa-envelope"></i>CONTACT
                                        </a>
                                    </li>
                                    <?php if(!App\Session::getUser()): ?> <!--Ajouter cette condition pour les utilisateurs non connectés -->
                                        <li>
                                            <a href="index.php?ctrl=security&action=login">
                                                <i class="fas fa-sign-in-alt"></i>CONNEXION
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </section>

                            <section class = "bottom"> <!-- Section inférieure de la navigation mobile.-->
                                    <ul class ="nav_mobile_social"> <!--les reseaux sociaux -->
                                        <li>
                                            <a href="https://www.instagram.com/jesuispassechezsouf/">instagram</a>
                                        </li>
                                        <li>
                                            <a href="https://www.facebook.com/jesuispassechezsouf">facebook</a>
                                        </li>
                                    </ul>
                            </section>
                        </nav>
                        
                        <div class="mobile-overlay" onclick="toggleMenu()"></div>
                        

                
                <main id="barber"> <!--conteneur principal de la page   -->
                    <?= $page ?> <!--affiche contenu de la page  -->
                </main>
            </div>
            <footer>
                    <div class="footer-container">
                        <div class="contact-info">
                            <h3>Informations de contact</h3>
                            <p>Téléphone : 04.50.75.03.39</p>
                            <p>Email : <a href="mailto:jesuispassechezsouf@gmail.com">jesuispassechezsouf@gmail.com</a></p>
                            <p>Adresse : 1 Allée Francois Truffaut, 74100 Annemasse</p>
                        </div>
                        <div class="horaires">
                            <h3>Horaires de rendez-vous</h3>
                            <p>Lundi - Vendredi : 09h00 - 18h00</p>
                            <p>Samedi : 09h00 - 12h00</p>
                            <p>Dimanche : Fermé</p>
                        </div>
                    </div>
                    <div class="legal">
                        <p>&copy; <?= date_create("now")->format("Y") ?> - <a href="index.php?ctrl=mentions&action=politique_confidentialite">Politique de confidentialité</a> - <a href="index.php?ctrl=mentionsl&action=mention_legal">Mentions légales</a></p>
                    </div>
            </footer>

        </div>
        

<script>document.addEventListener('DOMContentLoaded', function() {
    const nav_mobile = document.querySelector('.nav_mobile');
    const mobile_overlay = document.querySelector('.mobile-overlay');
    const nav_mobile_close = document.querySelector('.nav_mobile_close');
    const header_mobile = document.querySelector('.header_mobile');

    header_mobile.addEventListener('click', function() {
        nav_mobile.classList.add('active');
        mobile_overlay.classList.add('active');
    });

    nav_mobile_close.addEventListener('click', function() {
        nav_mobile.classList.remove('active');
        mobile_overlay.classList.remove('active');
    });

    mobile_overlay.addEventListener('click', function() {
        nav_mobile.classList.remove('active');
        mobile_overlay.classList.remove('active');
    });
});
</script>


        
<!--Lorsque je clique sur les icônes du menu mobile ou de 
fermeture, la fonction toggleMenu() est activée. Cette fonction 
s'occupe de montrer ou de cacher le menu mobile en fonction de son état actuel.
Si le menu est visible, il le cache, et s'il est caché, il le montre.
C'est comme un interrupteur -->

    </body>



</html>
