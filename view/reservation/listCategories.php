<?php
    $categories = $result["data"]['categories']; 
    $services = $result["data"]['services']; 
?>

<div class="listCategory">
    <h1>Liste des catégories</h1>
<br>
        <?php
        foreach($categories as $categorie ){ ?>
<p><a href="index.php?ctrl=reservation&action=listServiceByCategory&id=<?= $categorie->getId() ?>">
            <?= $categorie->getNomCategorie() ?></a></p>
           
        <?php

}?>


