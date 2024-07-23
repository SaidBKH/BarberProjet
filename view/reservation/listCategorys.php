<?php $categorys = $result["data"]['categorys']; ?>
<!-- Récupère la liste des catégories à partir des données du résultat. -->

<div class="Page category-list">
    <h1 class="Titre">Nos Catégories</h1>
    <p class="texte">Choisissez une catégorie pour voir les services disponibles.</p>
    <div class="category-container">
        <?php foreach ($categorys as $category): ?>
            <!-- Débute une boucle pour parcourir chaque catégorie. -->
            <a href="index.php?ctrl=reservation&action=listServiceByCategory&id=<?= $category->getId() ?>" class="category-item">
                <!-- Crée un lien vers la page des services de cette catégorie spécifique. -->
                <h2 class="category-title"><?= htmlspecialchars($category->getCategoryName()) ?></h2>
                <!-- Affiche le nom de la catégorie en échappant les caractères spéciaux pour la sécurité. -->
                <p class="category-description">Explorez nos services de <?= htmlspecialchars($category->getCategoryName()) ?></p>
                <!-- Affiche une description courte de la catégorie. -->
            </a>
        <?php endforeach; ?>
        <!-- Fin de la boucle des catégories. -->
    </div>
</div>