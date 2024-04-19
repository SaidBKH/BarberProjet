<!DOCTYPE html>   <!-- Indique au navigateur que le document est écrit en HTML-->
<html lang="en"> <!-- Indique au navigateur que le document est écrit en HTML-->
    <head>
        <meta charset="UTF-8">   <!-- Spécifie l'encodage des caractères comme UTF-8.-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configure la vue du port de l'appareil pour s'adapter à la largeur de l'écran.-->
        <meta name="description" content="<?= $meta_description ?>"> <!-- Fournit une description de la page pour les moteurs de recherche, avec une variable PHP pour la valeur.-->
        <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Spécifie la compatibilité avec Edge/Internet Explorer.-->

        <!-- Intègre TinyMCE, un éditeur de texte HTML en ligne.-->
        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
       <!-- Intègre Font Awesome, une bibliothèque d'icônes.-->
       
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
                    <img src="public/img/logo.png">  <!-- le logo-->

                    <div class="header_mobile" onclick="toggleMenu()"> 
                    <!-- Définition de l'icône pour ouvrir le menu -->
 
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </div>

                    <nav class="bureau">
                                <?php if(App\Session::getUser()): ?> <!--Vérifie si un utilisateur est connecté. -->
                                    <div class ="nav_bureau_profil">
                                        <a href="index.php?ctrl=user&action=profile">
                                            <span class="fas fa-user"></span>
                                            &nbsp;<?= App\Session::getUser()->getPrenom() ?>
                                        </a>
                                        <a href="index.php?ctrl=security&action=logout">Déconnexion</a>
                                    </div>
                                <?php endif; ?>
                                <ul class="nav_bureau_menu">
                                    <li>
                                        <a href="index.php">ACCUEIL</a>
                                   </li> 
                                    <li>
                                        <a href="#">Actualité</a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=reservation&action=listService">Réservations
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=services&action=nos_services">Nos Services</a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=rejoindre&action=nous_rejoindre">Nous rejoindre</a>
                                    </li>
                                    <li>
                                    <a href="index.php?ctrl=contact&action=contact">Contact
                                        </a>
                                    </li>
                                    <?php if(!App\Session::getUser()): ?> <!--Ajouter cette condition pour les utilisateurs non connectés -->
                                        <li>
                                            <a href="index.php?ctrl=security&action=login">
                                                <i class="fas fa-sign-in-alt"></i>Connexion
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
                                        <a href="index.php?ctrl=user&action=profile">
                                            <span class="fas fa-user"></span>
                                            &nbsp;<?= App\Session::getUser()->getPrenom() ?>
                                        </a>
                                        <a href="index.php?ctrl=security&action=logout">Déconnexion</a>
                                    </div>
                                <?php endif; ?>
                                <ul class="nav_mobile_menu">
                                    <li>
                                        <a href="index.php">
                                            <i class="fas fa-home"></i>ACCUEIL
                                        </a>
                                    </li> 
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-newspaper"></i>Actualité
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=reservation&action=listService">
                                            <i class="fas fa-calendar-check"></i>Réservations
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=services&action=nos_services">
                                            <i class="fas fa-toolbox"></i>Nos Services
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=rejoindre&action=nous_rejoindre">
                                            <i class="fas fa-users"></i>Nous rejoindre
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?ctrl=contact&action=contact">
                                            <i class="fas fa-envelope"></i>Contact
                                        </a>
                                    </li>
                                    <?php if(!App\Session::getUser()): ?> <!--Ajouter cette condition pour les utilisateurs non connectés -->
                                        <li>
                                            <a href="index.php?ctrl=security&action=login">
                                                <i class="fas fa-sign-in-alt"></i>Connexion
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </section>

                            <section class = "bottom"> <!-- Section inférieure de la navigation mobile.-->
                                    <ul class ="nav_mobile_social"> <!--les reseaux sociaux -->
                                            <a href="#">instagram</a>
                                        </li>
                                        <li>
                                            <a href="#">facebook</a>
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
            <div class ="footer">
                <br>
                <p>&copy; <?= date_create("now")->format("Y") ?> - <a href="#">politique de confidentialité </a> - <a href="#">Mentions légales</a></p>
            </footer>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function(){
                $(".message").each(function(){
                    if($(this).text().length > 0){
                        $(this).slideDown(500, function(){
                            $(this).delay(3000).slideUp(500)
                        })
                    }
                })
                $(".delete-btn").on("click", function(){
                    return confirm("Etes-vous sûr de vouloir supprimer?")
                })
                tinymce.init({
                    selector: '.post',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_css: '//www.tiny.cloud/css/codepen.min.css'
                });
            })
        </script>   
        <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script>
            function toggleMenu() {
                var menu = document.querySelector('.nav_mobile');
                var overlay = document.querySelector('.mobile-overlay');
                // Ajoute ou supprime la classe 'active' du menu
                menu.classList.toggle('active');
                overlay.classList.toggle('active');  
            }
        </script>
<!--Lorsque je clique sur les icônes du menu mobile ou de 
fermeture, la fonction toggleMenu() est activée. Cette fonction 
s'occupe de montrer ou de cacher le menu mobile en fonction de son état actuel.
Si le menu est visible, il le cache, et s'il est caché, il le montre.
C'est comme un interrupteur -->

    </body>



</html>
