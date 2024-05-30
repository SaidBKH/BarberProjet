<?php 
$services = $result["data"]['services'];
$category = $result["data"]['category'];
?>

<div class="listService">
    <h1>Catégorie : <?= $category->getCategoryName() ?></h1>
    <?php foreach ($services as $service): ?>
        <p><?= $service->getName() ?> <?= $service->getPrice() ?>€</p>
        <p>Durée : <?= $service->getDuration() ?> min</p>
        <!-- Bouton pour réserver -->
        <form action="index.php?ctrl=reservation&action=planningByService&id=<?=$service->getId() ?>" method="post">
            <input type="hidden" name="service_id" value="<?= $service->getId() ?>">
            <button type="submit">voir les disponibilités</button>
        </form>
    <?php endforeach; ?>
</div>