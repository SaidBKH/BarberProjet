<?php
namespace App;

use App\Manager;

// Récupération des publications depuis le contrôleur
$publications = $result["data"]['publications']; 
?>

<div class="Page page-header">
    <h1 class = "Titre">Actualités</h1>
    <p class="texte">Découvrez les dernières nouvelles et événements de notre salon de coiffure et barber.</p>


    <div class="list-news">
        <?php foreach ($publications as $publication) : ?>
            <div class="news">
                <h2 class="title-news"><?= htmlspecialchars($publication->getTitle()) ?></h2><br>
                <img src="public/img/<?= htmlspecialchars($publication->getPhoto()) ?>" alt="<?= htmlspecialchars($publication->getTitle()) ?>" class="photo-news">
                <p class="text-news"><?= nl2br(htmlspecialchars($publication->getText())) ?></p>
                <p class="date-news">Publié le : <?= Manager::formaterDateEnFrancais($publication->getDate()) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
