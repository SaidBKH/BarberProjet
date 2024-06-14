<?php 
$services = $result["data"]['services'];
$category = $result["data"]['category'];
?>

<div class="listService">
    <h1 class="reservation-header">Catégorie : <?= $category->getCategoryName() ?></h1>
    <p class="reservation-description">Sélectionnez un service pour voir les disponibilités.</p>
    <?php foreach ($services as $service): ?>
        <div class="service-item">
            <h2 class="service-title"><?= htmlspecialchars($service->getName()) ?> - <?= htmlspecialchars($service->getPrice()) ?>€</h2>
            <p class="service-duration">Durée : <?= htmlspecialchars($service->getDuration()) ?> min</p>
            <form action="index.php?ctrl=reservation&action=planningByService&id=<?= $service->getId() ?>" method="post">
                <input type="hidden" name="service_id" value="<?= $service->getId() ?>">
                <button type="submit" class="btn">Voir les disponibilités</button>
            </form>
        </div>
    <?php endforeach; ?>
    <button onclick="history.back()" class="btn">Retour</button>
</div>
