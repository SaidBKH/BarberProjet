<?php 
$services = $result["data"]['services'];
$category = $result["data"]['category'];
?>
<!-- Récupère les services disponibles et la catégorie actuelle à partir des données du résultat. -->

<div class="Page listService">
    <h1 class="Titre">Catégorie : <?= htmlspecialchars($category->getCategoryName()) ?></h1>
    <!-- Affiche le nom de la catégorie actuelle. -->
    <p class="text">Sélectionnez un service pour voir les disponibilités.</p>
    <!-- Invitation à sélectionner un service pour afficher les horaires disponibles. -->
    <div class="listServices">
        <?php foreach ($services as $service): ?>
            <!-- Débute une boucle pour parcourir chaque service. -->
            <div class="service-item">
                <!-- Conteneur pour chaque service individuel. -->
                <h2 class="service-title"><?= htmlspecialchars($service->getName()) ?></h2>
                <!-- Affiche le nom du service après avoir échappé les caractères spéciaux. -->
                <h2><?= htmlspecialchars($service->getPrice()) ?>€</h2>
                <!-- Affiche le prix du service après avoir échappé les caractères spéciaux. -->
                <p class="service-duration">Durée : <?= htmlspecialchars($service->getDuration()) ?> min</p>
                <!-- Affiche la durée du service en minutes après avoir échappé les caractères spéciaux. -->
                <form action="index.php?ctrl=reservation&action=planningByService&id=<?= $service->getId() ?>" method="post">
                    <!-- Formulaire pour afficher les disponibilités du service sélectionné. -->
                    <input type="hidden" name="service_id" value="<?= $service->getId() ?>">
                    <!-- Champ caché contenant l'ID du service pour l'envoyer avec le formulaire. -->
                    <button type="submit" class="btn-reservation">Voir les disponibilités</button>
                    <!-- Bouton pour soumettre le formulaire et voir les disponibilités du service. -->
                </form>
            </div>
        <?php endforeach; ?>
        <!-- Fin de la boucle des services. -->
    </div>

    <a href="http://localhost/BarberProjet/index.php?ctrl=reservation&action=listService" class="btn-annuler">Retour</a>    <!-- Bouton pour revenir à la page précédente  -->
</div>