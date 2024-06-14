 <?php
// Récupération des publications depuis le contrôleur
$publications = $result["data"]['publications']; 
?>

<div class="page-header">
    <h1>Actualités</h1>
    <p>Découvrez les dernières nouvelles et événements de notre salon de coiffure et barber.</p>


<div class="news-container">
    <?php foreach ($publications as $publication) : ?>
        <div class="news">
            <h2 class="title-news"><?= $publication->getTitle() ?></h2>
            <img src="public/img/<?= $publication->getPhoto() ?>" alt="<?= $publication->getTitle() ?>" class="photo-news">
            <p class="text-news"><?= $publication->getText() ?></p>
            <p class="date-news">Publié le : <?= date('d M Y', strtotime($publication->getDate())) ?></p>
        </div>
    <?php endforeach; ?>
</div>
</div>
