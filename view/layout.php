<!DOCTYPE html>   <!-- Indique au navigateur que le document est écrit en HTML-->
<html lang="fr"> <!-- Indique au navigateur que le document est écrit en HTML-->
    <head>
        <meta charset="UTF-8">   <!-- Spécifie l'encodage des caractères comme UTF-8.-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configure la vue du port de l'appareil pour s'adapter à la largeur de l'écran.-->
        <meta name="description" content="<?= $meta_description ?>"> <!-- Fournit une description de la page pour les moteurs de recherche, avec une variable PHP pour la valeur.-->
        <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Spécifie la compatibilité avec Edge/Internet Explorer.-->


    <!-- FullCalendar CSS -->
    <link href='https://unpkg.com/@fullcalendar/core@5.9.0/main.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/daygrid@5.9.0/main.min.css' rel='stylesheet' />
    
    <!-- FullCalendar JS -->
    <script src='https://unpkg.com/@fullcalendar/core@5.9.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid@5.9.0/main.min.js'></script>
    
    <!-- jQuery -->
    <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Vimeo Player API -->
    <script src="https://player.vimeo.com/api/player.js"></script>
    
    <!-- reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- International Telephone Input CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">

    <!-- International Telephone Input JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <!-- Tarteaucitron (Cookies) CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/tarteaucitronjs@1.9.6/tarteaucitron.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tarteaucitronjs@1.9.6/tarteaucitron.js"></script>

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
    <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.home.css">

    <title>Jesuispassechezsouf</title>
</head>

<body>
    <div id="wrapper">
        <div id="mainpage">
            <header class="header">
                <figure>
                    <a href="index.php">
                        <img src="public/img/logo.webp" alt="logo jesuispassechezsouf">
                    </a>
                </figure>
                <div class="header_mobile" onclick="toggleMenu()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </div>
                <nav class="bureau">
                    <ul class="nav_bureau_menu">
                        <li><a href="index.php">ACCUEIL</a></li>
                        <li><a href="index.php?ctrl=news&action=news">ACTUALITÉ</a></li>
                        <li><a href="index.php?ctrl=reservation&action=listService">RÉSERVATIONS</a></li>
                        <li><a href="index.php?ctrl=ourServices&action=ourServices">NOS SERVICES</a></li>
                        <li><a href="index.php?ctrl=joinUs&action=joinUs">NOUS REJOINDRE</a></li>
                        <li><a href="index.php?ctrl=contact&action=contact">CONTACT</a></li>
                        <?php if(!App\Session::getUser()): ?>
                            <li><a href="index.php?ctrl=security&action=login"><i class="fas fa-sign-in-alt"></i>CONNEXION</a></li>
                        <?php endif; ?>
                    </ul>
                    <?php if(App\Session::getUser()): ?>
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
                </nav>
            </header>

            <nav class="nav_mobile">
                <div class="nav_mobile_close" onclick="toggleMenu()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>

                <section class="top">
                    <?php if(App\Session::getUser()): ?>
                        <div class="nav_mobile_profil">
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
                        <li><a href="index.php"><i class="fas fa-home"></i>ACCUEIL</a></li>
                        <li><a href="index.php?ctrl=news&action=news"><i class="fas fa-newspaper"></i>ACTUALITÉ</a></li>
                        <li><a href="index.php?ctrl=reservation&action=listService"><i class="fas fa-calendar-check"></i>RÉSERVATION</a></li>
                        <li><a href="index.php?ctrl=ourServices&action=ourServices"><i class="fas fa-toolbox"></i>NOS SERVICES</a></li>
                        <li><a href="index.php?ctrl=joinUs&action=joinUs"><i class="fas fa-users"></i>NOUS REJOINDRE</a></li>
                        <li><a href="index.php?ctrl=contact&action=contact"><i class="fas fa-envelope"></i>CONTACT</a></li>
                        <?php if(!App\Session::getUser()): ?>
                            <li><a href="index.php?ctrl=security&action=login"><i class="fas fa-sign-in-alt"></i>CONNEXION</a></li>
                        <?php endif; ?>
                    </ul>
                </section>

                <section class="bottom">
                    <ul class="nav_mobile_social">
                        <li><a href="https://www.instagram.com/jesuispassechezsouf/">Instagram</a></li>
                        <li><a href="https://www.facebook.com/jesuispassechezsouf">Facebook</a></li>
                    </ul>
                </section>
            </nav>

            <div class="mobile-overlay" onclick="toggleMenu()"></div>

            <main id="barber">
                <?= $page ?>
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
                <p>&copy; <?= date("Y") ?> - <a href="index.php?ctrl=mentions&action=politique_confidentialite">Politique de confidentialité</a></p>
            </div>
        </footer>
    </div>

    <script>
        function toggleMenu() {
            const nav_mobile = document.querySelector('.nav_mobile');
            const mobile_overlay = document.querySelector('.mobile-overlay');
            nav_mobile.classList.toggle('active');
            mobile_overlay.classList.toggle('active');
        }

        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('scroll', function () {
                const header = document.querySelector('.header');
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        });
    </script>

    <script type="text/javascript">
        tarteaucitron.init({
            "privacyUrl": "index.php?ctrl=mentions&action=politique_confidentialite",
            "hashtag": "#tarteaucitron",
            "cookieName": "tarteaucitron",
            "orientation": "bottom",
            "showAlertSmall": false,
            "cookieslist": true,
            "adblocker": false,
            "AcceptAllCta": true,
            "highPrivacy": true,
            "handleBrowserDNTRequest": false,
            "removeCredit": true,
            "moreInfoLink": true,
            "useExternalCss": false,
            "useExternalJs": false,
            "mandatory": true,
            "lang": "fr"
        });

        tarteaucitron.user.analyticsUa = 'UA-XXXXXXX-X';
        (tarteaucitron.job = tarteaucitron.job || []).push('analytics');

        tarteaucitron.services.analytics = {
            "key": "analytics",
            "type": "analytic",
            "name": "Google Analytics",
            "uri": "https://analytics.google.com",
            "needConsent": true,
            "cookies": ['_ga', '_gat', '_gid'],
            "js": function () {
                "use strict";
                if (tarteaucitron.user.analyticsUa === undefined) {
                    return;
                }
                tarteaucitron.addScript('https://www.googletagmanager.com/gtag/js?id=' + tarteaucitron.user.analyticsUa, '', function () {
                    window.dataLayer = window.dataLayer || [];
                    function gtag() { dataLayer.push(arguments); }
                    gtag('js', new Date());
                    gtag('config', tarteaucitron.user.analyticsUa);
                });
            }
        };

        tarteaucitron.user.bookingWidgetUrl = 'https://yourbookingwidgeturl.com';
        (tarteaucitron.job = tarteaucitron.job || []).push('bookingWidget');

        tarteaucitron.services.bookingWidget = {
            "key": "bookingWidget",
            "type": "other",
            "name": "Widget de Réservation",
            "uri": "https://yourbookingwidgeturl.com",
            "needConsent": true,
            "cookies": ['booking_widget_cookie'],
            "js": function () {
                "use strict";
                tarteaucitron.addScript('https://yourbookingwidgeturl.com/widget.js');
            }
        };
    </script>
</body>

</html>
