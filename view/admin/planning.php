<?php 
$reservationsByMonth = $result["data"]['reservationsByMonth'];
?>

<div class="container-planning">
    <h1 class="Titre">Planning des Réservations</h1>
    <div class="list-group">
        <?php if (!empty($reservationsByMonth)): ?>
            <?php foreach ($reservationsByMonth as $row): ?>
                <?php 
                    $month = $row['month']; 
                    $count = $row['count']; 
                    // Utilisation de la fonction formaterDateEnFrancais pour convertir la date en mois
                    $formattedMonth = \App\Manager::formaterMoisEnFrancais($month);
                ?>
                <a href="index.php?ctrl=admin&action=reservationsByDay&month=<?= $month ?>" class="list-group-item list-group-item-action">
                    <?= $formattedMonth ?> (<?= $count ?> réservations)
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Aucune réservation trouvée.</p>
        <?php endif; ?>
    </div>
</div>
