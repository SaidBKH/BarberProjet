<?php
    $categories = $result["data"]['categories']; 
    $services = $result["data"]['services']; 
?>

<div class="listCategory">
    <h1>Liste des catégories</h1>
<br>
        <?php
        foreach($categories as $categorie ){ ?>
            <p><?= $categorie->getNomCategorie() ?></p>
        <?php

}?>

<div class="listService">
    <h1>Liste des services</h1>
<br>
<?php
        foreach($services as $service ){ ?>
            <p><?= $service->getNom() ?></p>
        <?php

}?>


