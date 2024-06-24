<?php  
$reservationsByDay = $result["data"]['reservationsByDay'] ?? [];
?>

<div class="Page container-planning">
    <h1 class="Titre">
        Réservations du Mois de <?= \App\Manager::formaterMoisEnFrancais($reservationsByDay[0]['day'] ?? null) ?>
    </h1>
    <div class="list-group">
        <?php foreach ($reservationsByDay as $row): ?>
            <?php 
                $day = $row['day'];
                $formattedDate = \App\Manager::formaterDateEnFrancais($day);
            ?>
            <a href="index.php?ctrl=admin&action=reservationsByDate&date=<?= $day ?>" class="list-group-item list-group-item-action">
                <?= $formattedDate ?> 
            </a>
        <?php endforeach; ?>
    </div>
</div>
