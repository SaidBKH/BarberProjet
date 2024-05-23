<?php
$dates = $result["data"]['dates'];
$selectedDate = $result["data"]['selectedDate'];
$reservations = $result["data"]['reservations'];
$message = $result["data"]['message'];
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Annuler des créneaux</h1>
    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-- Formulaire de sélection de la date -->
    <form method="post" action="">
        <div class="form-group">
            <label for="selected_date">Sélectionner une date</label>
            <select id="selected_date" name="selected_date" class="form-control" onchange="this.form.submit()">
                <option value="">Sélectionner une date</option>
                <?php foreach ($dates as $date): ?>
                    <option value="<?= htmlspecialchars($date->getDate()) ?>" <?= $selectedDate === $date->getDate() ? 'selected' : '' ?>>
                        <?= (new DateTime($date->getDate()))->format('d/m/Y') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <?php if ($selectedDate && $reservations): ?>
        <!-- Formulaire d'annulation de créneaux -->
        <form method="post" action="">
            <div class="form-group">
                <label for="creneaux">Sélectionner un créneau à annuler pour la date <?= (new DateTime($selectedDate))->format('d/m/Y') ?></label>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                            <tr>
                                <td><?= htmlspecialchars($reservation->getService()->getNom()) ?></td>
                                <td><?= (new DateTime($reservation->getDate()))->format('d/m/Y') ?></td>
                                <td><?= htmlspecialchars($reservation->getHeure()) ?></td>
                                <td>
                                    <button type="submit" name="annuler_creneau" value="<?= htmlspecialchars($reservation->getId()) ?>" class="btn btn-danger">Annuler</button>
                                    <input type="hidden" name="creneau_id" value="<?= htmlspecialchars($reservation->getId()) ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </form>
    <?php elseif ($selectedDate): ?>
        <p class="text-center">Aucun créneau trouvé pour cette date.</p>
    <?php endif; ?>
</div>
