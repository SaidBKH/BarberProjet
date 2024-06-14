<?php
// Récupération des publications depuis le contrôleur
$publications = $result["data"]['publications']; 
?>


    <div class="page-header">
        <div class="top-header">
            <h1>Actualités</h1>
            <p>Découvrez les dernières nouvelles et événements de notre salon de coiffure et barber.</p>
        </div>

        <div class="list-new">
            <?php foreach ($publications as $publication) : ?>
                <div class="news">
                    <h2 class="title-news"><?= htmlspecialchars($publication->getTitle()) ?></h2>
                    <img src="public/img/<?= htmlspecialchars($publication->getPhoto()) ?>" alt="<?= htmlspecialchars($publication->getTitle()) ?>" class="photo-news">
                    <p class="text-news"><?= nl2br(htmlspecialchars($publication->getText())) ?></p>
                    <p class="date-news">Publié le : <?= date('d M Y', strtotime($publication->getDate())) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

