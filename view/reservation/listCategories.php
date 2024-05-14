<?php
    $categories = $result["data"]['categories']; 
?>

<div class="category-list">
    <h1>Nos Catégories</h1>

    <div class="category-container">
        <?php foreach ($categories as $categorie): ?>
            <a href="index.php?ctrl=reservation&action=listServiceByCategory&id=<?= $categorie->getId() ?>" class="category-item">
                <h2><?= htmlspecialchars($categorie->getNomCategorie()) ?></h2>
                <p>Explorez nos services de <?= htmlspecialchars($categorie->getNomCategorie()) ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div>
