<?php
// Importation de la classe Manager depuis l'espace de noms App
use App\Manager;

// Récupération des réservations à partir du tableau de résultats
$reservations = $result["data"]['reservations']; 
?>

<div class="Page container-planning-jour">
    <h1 class="Titre">
        Réservations du <?= Manager::formaterDateEnFrancais($reservations[0]['date']) ?>
    </h1>

    <div class="list-group-by-date">
        <?php 
        foreach ($reservations as $reservation): 
        ?>
            <div class="list-item-by-date">
                <div class="list-item-header">
                    <!-- Formater l'heure pour obtenir le format HH:MM -->
                    <?= date('H:i', strtotime($reservation['heure'])) ?>
                </div>
                <div class="list-item-body">
                    <h5 class="list-item-title"><?= htmlspecialchars($reservation['service_name']) ?></h5>
                    <p class="list-item-text">
                        <strong>Client:</strong> <?= htmlspecialchars($reservation['prenom']) ?><br>
                        <strong>Email:</strong> <?= htmlspecialchars($reservation['email']) ?><br>
                        <?= isset($reservation['telephone']) ? '<strong>Téléphone:</strong> ' . htmlspecialchars($reservation['telephone']) : '' ?>
                    </p>
                </div>
            </div>
        <?php 
        endforeach; 
        ?>
    </div>
</div>
