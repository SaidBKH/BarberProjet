<?php $categorys = $result["data"]['categorys']; ?>

<div class="Page category-list">
    <h1 class="Titre">Nos Catégories</h1>
    <p class="texte">Choisissez une catégorie pour voir les services disponibles.</p>
    <div class="category-container">
        <?php foreach ($categorys as $category): ?>
            <a href="index.php?ctrl=reservation&action=listServiceByCategory&id=<?= $category->getId() ?>" class="category-item">
                <h2 class="category-title"><?= htmlspecialchars($category->getCategoryName()) ?></h2>
                <p class="category-description">Explorez nos services de <?= htmlspecialchars($category->getCategoryName()) ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div>
