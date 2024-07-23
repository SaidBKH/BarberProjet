<?php
// Récupération des données nécessaires depuis le tableau $result
$dates = $result["data"]['dates']; // Liste des dates disponibles
$selectedDate = $result["data"]['selectedDate']; // Date actuellement sélectionnée
$reservations = $result["data"]['reservations']; // Réservations pour la date sélectionnée
$message = $result["data"]['message']; // Message d'information ou d'erreur
?>

<!-- Conteneur principal avec marges supérieures -->
<div class="Page container mt-5">
    <!-- Titre principal de la page -->
    <h1 class="Titre">Annuler des créneaux</h1>

    <!-- Affichage du message d'information s'il existe -->
    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-- Formulaire de sélection de la date -->
    <form method="post" action="">
        <div class="form-group">
            <label for="selected_date">Sélectionner une date</label>
            <!-- Menu déroulant pour choisir une date -->
            <select id="selected_date" name="selected_date" class="form-control" onchange="this.form.submit()">
                <option value="">Sélectionner une date</option>
                <!-- Boucle sur les dates pour créer les options du menu déroulant -->
                <?php foreach ($dates as $date): ?>
                    <option value="<?= htmlspecialchars($date->getDate()) ?>" <?= $selectedDate === $date->getDate() ? 'selected' : '' ?>>
                        <?= (new DateTime($date->getDate()))->format('d/m/Y') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <!-- Affichage du formulaire d'annulation de créneaux si une date est sélectionnée et qu'il y a des réservations -->
    <?php if ($selectedDate && $reservations): ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="creneaux">Sélectionner un créneau à annuler pour la date <?= (new DateTime($selectedDate))->format('d/m/Y') ?></label>
                <!-- Tableau des créneaux -->
                <table class="table table-bordered text-white">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Boucle sur les réservations pour créer les lignes du tableau -->
                        <?php foreach ($reservations as $reservation): ?>
                            <tr>
                                <!-- Affichage des détails de la réservation -->
                                <td><?= htmlspecialchars($reservation->getService()->getName()) ?></td>
                                <td><?= (new DateTime($reservation->getDate()))->format('d/m/Y') ?></td>
                                <td><?= htmlspecialchars($reservation->getHeure()) ?></td>
                                <td>
                                    <!-- Bouton pour annuler la réservation -->
                                    <button type="submit" name="annuler_creneau" value="<?= htmlspecialchars($reservation->getId()) ?>" class="btn btn-danger">Annuler</button>
                                    <!-- Champ caché pour stocker l'ID du créneau -->
                                    <input type="hidden" name="creneau_id" value="<?= htmlspecialchars($reservation->getId()) ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </form>
    <?php elseif ($selectedDate): ?>
        <!-- Message affiché si aucune réservation n'est trouvée pour la date sélectionnée -->
        <p class="text-center">Aucun créneau trouvé pour cette date.</p>
    <?php endif; ?>
</div>
