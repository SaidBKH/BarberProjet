<?php 
$reservations = $result["data"]['reservations'];
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Planning des Réservations</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Client</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <?php 
                        $client = $reservation->getClient();
                        if ($client && method_exists($client, 'getPrenom')): ?>
                            <tr class="reservation-row" data-toggle="modal" data-target="#reservationDetailsModal" data-details='<?= json_encode([
                                'Date' => $reservation->getDate(),
                                'Heure' => $reservation->getHeure(),
                                'Prénom' => $client->getPrenom(),
                                'Email' => $client->getEmail(),
                                'Téléphone' => $client->getTelephone()
                            ]) ?>'>
                                <td><?= $reservation->getDate() ?></td>
                                <td><?= $reservation->getHeure() ?></td>
                                <td><?= $client->getPrenom() ?></td>
                            </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Reservation Details Modal -->
<div class="modal fade" id="reservationDetailsModal" tabindex="-1" role="dialog" aria-labelledby="reservationDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationDetailsModalLabel">Détails de la Réservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="reservationDetails"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Afficher les détails de la réservation au clic sur une ligne de la table
    $('.reservation-row').on('click', function() {
        var reservationDetails = $(this).data('details');
        var detailsHtml = '';
        $.each(reservationDetails, function(key, value) {
            detailsHtml += '<p><strong>' + key + ':</strong> ' + value + '</p>';
        });
        $('#reservationDetails').html(detailsHtml);
    });
});
</script>
