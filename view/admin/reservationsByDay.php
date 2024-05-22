<?php  
$reservationsByDay = $result["data"]['reservationsByDay'] ?? [];
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Réservations du Mois</h1>
    <div class="list-group">
        <?php foreach ($reservationsByDay as $row): ?>
            <?php $day = $row['day'];   ?>
            <a href="index.php?ctrl=admin&action=reservationsByDate&date=<?= $day ?>" class="list-group-item list-group-item-action">
                <?= date("d F Y", strtotime($day)) ?> 
            </a>
        <?php endforeach; ?>
    </div>
</div>
