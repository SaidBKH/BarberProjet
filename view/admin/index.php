<?php 
$reservations = $result["data"]['reservations'];
?>


<h1>Tableau de bord</h1>
    
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Client</th>
            <th>Email</th>
            <th>Téléphone</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reservations as $reservation): ?>
            <?php 
            $client = $reservation->getClient();
            if ($client && method_exists($client, 'getEmail')): ?>
                <tr>
                    <td><?= $reservation->getDate() ?></td>
                    <td><?= $reservation->getHeure() ?></td>
                    <td><?= $client->getPrenom() ?></td>
                    <td><?= $client->getEmail() ?></td>
                    <td><?= $client->getTelephone() ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>
