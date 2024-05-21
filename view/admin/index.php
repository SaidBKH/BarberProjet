<?php 
$reservationsByMonth = $result["data"]['reservationsByMonth'] ?? [];
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Planning des Réservations</h1>
    <div class="list-group">
        <?php if (!empty($reservationsByMonth)): ?>
            <?php foreach ($reservationsByMonth as $row): ?>
                <?php $month = $row['month']; $count = $row['count']; ?>
                <a href="index.php?ctrl=admin&action=reservationsByDay&month=<?= $month ?>" class="list-group-item list-group-item-action">
                    <?= date("F Y", strtotime($month)) ?> (<?= $count ?> réservations)
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Aucune réservation trouvée.</p>
        <?php endif; ?>
    </div>
</div>
