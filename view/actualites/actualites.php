<?php
// Récupération des publications depuis le contrôleur
$publications = $result["data"]['publications']; 
?>

<div class="actualites-container">
    <?php foreach ($publications as $publication) : ?>
        <div class="actualite">
            <h2 class="titre-actualite"><?= $publication->getTitre() ?></h2>
            <img src="<?= $publication->getPhoto() ?>" alt="<?= $publication->getTitre() ?>" class="image-actualite">
            <p class="texte-actualite"><?= $publication->getTexte() ?></p>
        </div>
    <?php endforeach; ?>
</div>