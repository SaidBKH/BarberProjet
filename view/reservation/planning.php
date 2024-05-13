<?php
    $plannings = $result["data"]['planning']; 
    $services = $result["data"]['services']; 
?>

    <h1>Liste disponibilite</h1>
<br>


<?php foreach ($disponibilites as $disponibilite) : ?>
    <p>
        <a href="index.php?ctrl=reservation&action=listDisponibilite=<?= $service->getId() ?>">
            <?= $disponibilite->getHeure() ?> <?= $disponibilite->getDate() ?>
        </a>
    </p>
<?php endforeach; ?>