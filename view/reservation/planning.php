<?php
use App\Manager;

// Configuration de la localisation en français
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.UTF-8');

// Initialisation de la variable pour l'heure sélectionnée
$heureSelectionnee = '';

// Récupération de l'ID du service depuis l'URL, si disponible
$service = isset($_GET['id']) ? $_GET['id'] : null;
?>

<?php
$plannings = $result["data"]['planning'];
$service = $result["data"]['service'];

// Tableau pour regrouper les plannings par date
$planningsParDate = [];

// Regrouper les plannings par date
foreach ($plannings as $planning) {
    $date = $planning->getDate();
    $heure = $planning->getHeure();

    if (!isset($planningsParDate[$date])) {
        $planningsParDate[$date] = [];
    }

    $planningsParDate[$date][] = $heure;
}
?>

<div class="Page container-reservation">
    <h1 class="Titre">Liste des disponibilités</h1>
    <!-- Titre de la section affichant les disponibilités. -->

    <?php if (empty($planningsParDate)) : ?>
        <!-- Si aucune disponibilité n'est trouvée, afficher ce message. -->
        <p class="texte">Aucune disponibilité pour ce service.</p>
    <?php else : ?>
        <!-- Sinon, afficher les disponibilités groupées par date. -->
        <div class="heure-grid">
            <?php foreach ($planningsParDate as $date => $heures) : ?>
                <!-- Débute une boucle pour parcourir chaque date avec des heures disponibles. -->
                <div class="colonne-date">
                    <!-- Conteneur pour les heures disponibles d'une date spécifique. -->
                    <h2 class="date-dispo"><?= Manager::formaterDateEnFrancais($date) ?></h2>
                    <!-- Affiche la date formatée en français. -->
                    <div class="heures">
                        <?php foreach ($heures as $heure) : ?>
                            <!-- Débute une boucle pour parcourir chaque heure disponible pour cette date. -->
                            <div class="cellule-heure" data-heure="<?= $heure ?>" data-jour="<?= $date ?>" onclick="selectionnerHeure(this)">
                                <?= $heure ?>
                                <!-- Affiche l'heure disponible. Lors du clic, appelle la fonction JavaScript `selectionnerHeure`. -->
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- Fin de la boucle des heures disponibles par date. -->
        </div>

        <div class="recapitulatif">
            <h3>Récapitulatif de la réservation :</h3>
            <!-- Section pour afficher le récapitulatif de la réservation. -->
            <p>Date : <span id="recap-date"></span></p>
            <!-- Affiche la date sélectionnée dans le récapitulatif. -->
            <p>Heure : <span id="recap-heure"></span></p>
            <!-- Affiche l'heure sélectionnée dans le récapitulatif. -->
            <p>Service : <?= htmlspecialchars($service->getName()) ?></p>
            <!-- Affiche le nom du service sélectionné en échappant les caractères spéciaux. -->
        </div>
        <form action="index.php?ctrl=reservation&action=reserve" method="post">
            <!-- Formulaire pour confirmer la réservation avec les détails sélectionnés. -->
            <input id="horaire" type="hidden" name="heure_selectionnee">
            <!-- Champ caché pour stocker l'heure sélectionnée. -->
            <input type="hidden" name="service_id" value="<?= $service->getId() ?>">
            <!-- Champ caché pour stocker l'ID du service sélectionné. -->
            <input id="date" type="hidden" name="date">
            <!-- Champ caché pour stocker la date sélectionnée. -->
            <div class="boutons-planning">
                <!-- Conteneur pour les boutons de la planification. -->
                <button class="btn-reservation-planning" type="submit">Réserver</button>
                <!-- Bouton pour soumettre la réservation. -->
                <a href="javascript:history.back()" class="btn-annuler">Retour</a>
                <!-- Bouton pour annuler ou revenir à l'étape précédente. -->
            </div>
            <p class="warning-message">Attention : En cliquant sur "Réserver", votre réservation sera confirmée.</p>
            <!-- Message d'avertissement avant la confirmation de la réservation. -->
        </form>
    <?php endif; ?>
    <!-- Fin de la condition pour afficher les disponibilités ou un message d'absence de disponibilités. -->
</div>

<script>
function selectionnerHeure(celluleHeure) {
    // Fonction appelée lorsqu'une heure est sélectionnée.
    const toutesLesHeures = document.querySelectorAll('.cellule-heure');
    // Sélectionne toutes les cellules d'heure disponibles.
    toutesLesHeures.forEach(cellule => {
        cellule.classList.remove('selectionnee');
        // Retire la classe 'selectionnee' de toutes les cellules d'heure.
    });

    celluleHeure.classList.add('selectionnee');
    // Ajoute la classe 'selectionnee' à la cellule d'heure sélectionnée.

    const horaire = document.querySelector("#horaire");
    horaire.value = celluleHeure.dataset.heure;
    // Met à jour le champ caché avec l'heure sélectionnée.

    const date = document.querySelector("#date");
    date.value = celluleHeure.dataset.jour;
    // Met à jour le champ caché avec la date sélectionnée.

    const recapDate = document.querySelector("#recap-date");
    const recapHeure = document.querySelector("#recap-heure");

    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateObj = new Date(celluleHeure.dataset.jour);
    recapDate.textContent = dateObj.toLocaleDateString('fr-FR', options);
    // Formate la date en français et l'affiche dans le récapitulatif.

    recapHeure.textContent = celluleHeure.dataset.heure;
    // Affiche l'heure sélectionnée dans le récapitulatif.
}
</script>