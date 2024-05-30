<?php
// Récupération des publications depuis le contrôleur
$publications = $result["data"]['publications']; 
?>

<div class="news-container">
    <?php foreach ($publications as $publication) : ?>
        <div class="news">
            <h2 class="title-news"><?= $publication->getTitle() ?></h2>
            <img src="public/img/<?= $publication->getPhoto() ?>" alt="<?= $publication->getTitle() ?>" class="photo-news">
            <p class="text-news"><?= $publication->getText() ?></p>
        </div>
    <?php endforeach; ?>
</div>



