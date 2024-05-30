<?php 
$reservations = $result["data"]['reservations']; 
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Réservations du <?= date("d F Y", strtotime($reservations[0]['date'])) ?></h1>
    <div class="table-responsive">
        <table class="table table-bordered table-dark">
            <thead class="thead-dark">
                <tr>
                    <th>Service</th>
                    <th>Heure</th>
                    <th>Client</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr class="reservation-row" data-toggle="modal" data-target="#reservationDetailsModal" data-details='<?= json_encode([
                        'Service' => htmlspecialchars($reservation['service_nom']),
                        'Heure' => htmlspecialchars($reservation['heure']),
                        'Prénom' => htmlspecialchars($reservation['prenom']),
                        'Email' => htmlspecialchars($reservation['email']),
                        'Téléphone' => isset($reservation['telephone']) ? htmlspecialchars($reservation['telephone']) : ''
                    ]) ?>'>
                        <td><?= htmlspecialchars($reservation['service_name']) ?></td>
                        <td><?= htmlspecialchars($reservation['heure']) ?></td>
                        <td>
                            <?= htmlspecialchars($reservation['prenom']) ?><br>
                            <?= htmlspecialchars($reservation['email']) ?><br>
                            <?= isset($reservation['telephone']) ? htmlspecialchars($reservation['telephone']) : '' ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
