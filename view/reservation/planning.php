<?php
use App\Manager;

// Configuration de la localisation en français
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.UTF-8');

$heureSelectionnee = '';

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
    <h1 class = "Titre">Liste des disponibilités</h1>

    <?php if (empty($planningsParDate)) : ?>
        <p class="texte">Aucune disponibilité pour ce service.</p>
    <?php else : ?>
        <div class="heure-grid">
            <?php foreach ($planningsParDate as $date => $heures) : ?>
                <div class="colonne-date">
                    <h2 class="date-dispo"><?= Manager::formaterDateEnFrancais($date) ?></h2>
                    <div class="heures">
                        <?php foreach ($heures as $heure) : ?>
                            <div class="cellule-heure" data-heure="<?= $heure ?>" data-jour="<?= $date ?>" onclick="selectionnerHeure(this)">
                                <?= $heure ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="recapitulatif">
            <h3>Récapitulatif de la réservation :</h3>
            <p>Date : <span id="recap-date"></span></p>
            <p>Heure : <span id="recap-heure"></span></p>
            <p>Service : <?= htmlspecialchars($service->getName()) ?></p>
        </div>
        <form action="index.php?ctrl=reservation&action=reserve" method="post">
            <input id="horaire" type="hidden" name="heure_selectionnee">
            <input type="hidden" name="service_id" value="<?= $service->getId() ?>">
            <input id="date" type="hidden" name="date">
            <div class = boutons-planning>
            <button class="btn-reservation-planning" type="submit">Réserver</button>
            <button class="btn-annuler-planning" type="submit">Retour</button>
            </div>
            <p class="warning-message">Attention : En cliquant sur "Réserver", votre réservation sera confirmée.</p>

        </form>
    <?php endif; ?>
</div>

<script>
function selectionnerHeure(celluleHeure) {
    const toutesLesHeures = document.querySelectorAll('.cellule-heure');
    toutesLesHeures.forEach(cellule => {
        cellule.classList.remove('selectionnee');
    });

    celluleHeure.classList.add('selectionnee');

    const horaire = document.querySelector("#horaire");
    horaire.value = celluleHeure.dataset.heure;

    const date = document.querySelector("#date");
    date.value = celluleHeure.dataset.jour;

    const recapDate = document.querySelector("#recap-date");
    const recapHeure = document.querySelector("#recap-heure");

    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateObj = new Date(celluleHeure.dataset.jour);
    recapDate.textContent = dateObj.toLocaleDateString('fr-FR', options);
    recapHeure.textContent = celluleHeure.dataset.heure;
}
</script>
