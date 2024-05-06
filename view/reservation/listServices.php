<?php 
$services = $result["data"]['services'];
$categorie = $result["data"]['categorie'];
?>

<div class="listService">
    <h1>Catégorie : <?= $categorie->getNomCategorie() ?></h1>
    <?php foreach ($services as $service): ?>
        <p><?= $service->getNom() ?> <?= $service->getPrix() ?>€</p>
        <p>Durée : <?= $service->getDuree() ?> min</p>
        <!-- Bouton pour réserver -->
        <form action="index.php?ctrl=reservation&action=makeReservation" method="post">
            <input type="hidden" name="service_id" value="<?= $service->getId() ?>">
            <button type="submit">Réserver</button>
        </form>
    <?php endforeach; ?>
</div>