<div class="main-container">


    <div class="accueil-top">
        <video autoplay muted loop id="background-video">
            <source src="public/img/salon.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="content">
            <h1 class="title">JE SUIS PASSÉ CHEZ SOUF</h1>
            <a href="index.php?ctrl=reservation&action=listService"><button class="btn-rdv">Prendre rendez-vous</button></a>
        </div>
    </div>

    <div class="gradientAccueil"></div>


    <div class="accueil-presentation">
        
        <div class="texte-presentation">
            <h2>Salon de Coiffure à Annemasse !</h2>
            <br>
            <p>Jesuispasséchezsouf est la concrétisation d'un concept du barber idéal perçu par son créateur, un lieu où l'on revient sans hésiter !
                Imaginer comme une thérapie de bien être, ou l'on vient vivre un moment régénérateur et repartir avec d'avantage d'assurance et un style des plus adapté à sa personnalité.</p>
        </div>
        <figure>
            <img class="devanture" src="public/img/devanture.jpeg" alt="Devanture du salon de coiffure">
        </figure>
    </div>

    <div class="gradientServices"></div>

<div class="services" id="services">
    <h2 class="services-title">Nos Services</h2>
    <div class="list-services">
        <figure>
            <a href="index.php?ctrl=services&action=nos_services" class="service-lien">
                <img class="services" src="public/img/nos_services1.jpeg" alt="coupe de cheveux">
                <div class="image-overlay">
                    <p class="overlay-text">CHEVEUX <br><i class="fas fa-cut"></i></p>
                </div>
            </a>
        </figure>
        <figure>
            <a href="index.php?ctrl=services&action=nos_services" class="service-lien">
                <img class="services" src="public/img/nos_services2.jpeg" alt="barbe">
                <div class="image-overlay">
                    <p class="overlay-text">BARBE <br><i class="fas fa-spa"></i>
                    </p>
                </div>
            </a>
        </figure>
        <figure>
            <a href="index.php?ctrl=services&action=nos_services" class="service-lien">
                <img class="services" src="public/img/nos_services3.jpeg" alt="Soins du visage">
                <div class="image-overlay">
                    <p class="overlay-text">SOINS <br><i class="fas fa-shower"></i></p>
                </div>
            </a>
        </figure>
        <figure>
            <a href="index.php?ctrl=services&action=nos_services" class="service-lien">
                <img class="services" src="public/img/nos_services4.jpeg" alt="coloration de cheveux">
                <div class="image-overlay">
                    <p class="overlay-text">COULEUR <br><i class="fas fa-paint-brush"></i></p>
                </div>
            </a>
        </figure>
    </div>
</div>

<div class="gradientInstagram"></div>

<div class="instagram">
    <div class="instagram-contenu">
        <h2>Suivez-nous sur Instagram</h2>
        <figure class="logo">
            <a href="index.php"><img src="public/img/logo.png" alt="logo jesuispassechezsouf"></a>
        </figure>
        <p>Découvrez nos dernières créations et inspirations en nous suivant sur Instagram.</p>
        <a href="https://www.instagram.com/jesuispassechezsouf/" class="instagram-lien">
            <i class="fab fa-instagram"></i>
            <span>@jesuispassechezsouf</span>
        </a>
    </div>
</div>




    <?php
        $images = $result["data"]['images']; 
    ?>

<div class="swiper-container">
    <div class="swiper-wrapper">
    <?php foreach ($images as $image) : ?>
        <div class="swiper-slide">
            <img src="public/img/<?= $image->getImageUrl() ?>" alt="<?= $image->getTitre() ?>">
        </div>
    <?php endforeach; ?>
    </div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</div>


<script>
// Initialiser Swiper.js avec les options souhaitées
const swiper = new Swiper('.swiper-container', {
    slidesPerView: 1, // Nombre de diapositives visibles par défaut
    spaceBetween: 10, // Espacement entre les diapositives
    loop: true, // Boucle infinie
    autoplay: {
        delay: 3000, // Délai entre les transitions automatiques
    },
    navigation: {
        nextEl: '.swiper-button-next', // Sélecteur du bouton suivant
        prevEl: '.swiper-button-prev', // Sélecteur du bouton précédent
    },
    breakpoints: {
        // Pour les écrans plus petits que 768px de largeur
        768: {
            slidesPerView: 3, // Afficher une seule diapositive
        }
    }
});
</script>


    
<div class="newsletter-container">
    <div class="newsletter">
        <h2>Ne manquez aucune offre spéciale !</h2>
        <p>Inscrivez-vous à notre newsletter pour être informé en avant-première de nos offres exclusives.</p>
        <form action="traitement-newsletter.php" method="POST" class="subscribe-form">
            <div class="input-container">
                <input type="email" name="email" placeholder="Votre adresse e-mail" required>
                <button type="submit">S'abonner</button>
            </div>
        </form>
    </div>
</div>


</div>

