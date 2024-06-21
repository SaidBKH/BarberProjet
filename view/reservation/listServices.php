<?php 
$services = $result["data"]['services'];
$category = $result["data"]['category'];
?>

<div class="Page listService">


    <h1 class = "Titre">Catégorie : <?= $category->getCategoryName() ?></h1>
    <p class="text">Sélectionnez un service pour voir les disponibilités.</p>
    <div class="listServices">
    <?php foreach ($services as $service): ?>
        <div class="service-item">
            <h2 class="service-title"><?= htmlspecialchars($service->getName()) ?></h2>
            <h2><?= htmlspecialchars($service->getPrice()) ?>€</h2>
            <p class="service-duration">Durée : <?= htmlspecialchars($service->getDuration()) ?> min</p>
            <form action="index.php?ctrl=reservation&action=planningByService&id=<?= $service->getId() ?>" method="post">
                <input type="hidden" name="service_id" value="<?= $service->getId() ?>">
                <button type="submit" class="btn-reservation">Voir les disponibilités</button>
            </form>
        </div>
    <?php endforeach; ?>
    </div>
    <button class="btn-annuler-planning" type="submit">Retour</button>
</div>
