<div class="main-container">

    <div class="accueil-top">
        <h1 class="title">JE SUIS PASSÉ CHEZ SOUF</h1>
        <button class="btn-rdv">Prendre rendez-vous</button>
    </div>

    <div class="accueil-presentation">
        <figure>
            <img class="devanture" src="public/img/devanture.jpeg" alt="Devanture">
        </figure>
        <div class="texte-presentation">
            <h2>Salon de Coiffure à Annemasse !</h2>
            <br>
            <p>Jesuispasséchezsouf est la concrétisation d'un concept du barber idéal perçu par son créateur, un lieu où l'on revient sans hésiter !
                Imaginer comme une thérapie de bien être, ou l'on vient vivre un moment régénérateur et repartir avec d'avantage d'assurance et un style des plus adapté à sa personnalité.</p>
        </div>
    </div>

    <div class="list-services">
        <figure>
            <a href="lien-service1" class="service-lien">
                <img class="services" src="public/img/nos_services1.jpeg" alt="Service 1">
                <div class="image-overlay">
                    <p class="overlay-text">CHEVEUX</p>
                </div>
            </a>
        </figure>
        <figure>
            <a href="lien-service2" class="service-lien">
                <img class="services" src="public/img/nos_services2.jpeg" alt="Service 2">
                <div class="image-overlay">
                    <p class="overlay-text">BARBE</p>
                </div>
            </a>
        </figure>
        <figure>
            <a href="lien-service3" class="service-lien">
                <img class="services" src="public/img/nos_services3.jpeg" alt="Service 3">
                <div class="image-overlay">
                    <p class="overlay-text">SOINS</p>
                </div>
            </a>
        </figure>
        <figure>
            <a href="lien-service4" class="service-lien">
                <img class="services" src="public/img/image3.jpeg" alt="Service 4">
                <div class="image-overlay">
                    <p class="overlay-text">COULEUR</p>
                </div>
            </a>
        </figure>
    </div>

</div>

    <div class="instagram">
        <div class="instagram-contenu">
            <h2>Suivez-nous sur Instagram</h2>
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
        <img src="<?= $image->getImageUrl() ?>" alt="<?= $image->getTitre() ?>">
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
  slidesPerView: 3, // Nombre de diapositives visibles par défaut
  spaceBetween: 10, // Espacement entre les diapositives
  loop: true, // Boucle infinie
  autoplay: {
    delay: 3000, // Délai entre les transitions automatiques
  },
  navigation: {
    nextEl: '.swiper-button-next', // Sélecteur du bouton suivant
    prevEl: '.swiper-button-prev', // Sélecteur du bouton précédent
  },
});

</script>


</div>

<div class="newletter">

<div class="newsletter">
  <h2>Abonnez-vous à notre newsletter</h2>
  <form action="traitement-newsletter.php" method="POST">
    <input type="email" name="email" placeholder="Votre adresse e-mail" required>
    <button type="submit">S'abonner</button>
  </form>
</div>

</div>

<div class="footer">
</div>
