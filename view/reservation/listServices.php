<?php 
$services = $result["data"]['services'];
$categorie = $result["data"]['categorie'];
?>

<div class="listService">
    <h1>Categorie  : <?= $categorie->getNomCategorie() ?></h1>
<br>
<!-- boucle pour afficher la liste des services -->
<?php
        foreach($services as $service ){ ?>
            <p><?= $service->getNom() ?> <?= $service->getPrix() ?>€ </p>
            <p>durée : <?= $service->getDuree() ?> min</p>
        <?php

}?>