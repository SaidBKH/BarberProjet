<?php
    $categorys = $result["data"]['categorys']; 
?>

<div class="category-list">
    <h1>Nos Catégories</h1>

    <div class="category-container">
        <?php foreach ($categorys as $category): ?>
            <a href="index.php?ctrl=reservation&action=listServiceByCategory&id=<?= $category->getId() ?>" class="category-item">
                <h2><?= htmlspecialchars($category->getCategoryName()) ?></h2>
                <p>Explorez nos services de <?= htmlspecialchars($category->getCategoryName()) ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div>
