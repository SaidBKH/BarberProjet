<?php
    $plannings = $result["data"]['planning']; 
    $services = $result["data"]['services']; 
    
    // Tableau pour regrouper les plannings par date
    $planningsParDate = [];

    // Regrouper les plannings par date
    foreach ($plannings as $planning) {
        $date = $planning->getDate();
        $heure = $planning->getHeure();

        // Convertir la date en objet DateTime pour obtenir le jour de la semaine et le jour du mois
        $dateTime = new DateTime($date);
        $jourSemaine = $dateTime->format('l'); // 'l' pour le jour de la semaine complet
        $jourMois = $dateTime->format('j F'); // 'j' pour le jour sans zéro, 'F' pour le mois complet en lettres

        // Formatage du jour au format "Jour de la semaine, Jour Mois"
        $jourFormate = $jourSemaine . '<br> ' . $jourMois;

        // Si la date n'existe pas dans le tableau, l'initialiser avec un tableau vide
        if (!isset($planningsParDate[$jourFormate])) {
            $planningsParDate[$jourFormate] = [];
        }

        // Ajouter l'heure à la liste des horaires pour cette date
        $planningsParDate[$jourFormate][] = $heure;
    }
?>




<div class="container-reservation">
    <h1 class="tableau-disponibilite">Liste des disponibilités</h1>

    <?php if (empty($planningsParDate)) : ?>
        <p>Aucune disponibilité pour ce service.</p>
    <?php else : ?>
        <div class="heure-grid">
            <?php foreach ($planningsParDate as $jourFormate => $heures) : ?>
                <div class="colonne-date">
                    <h2><?= $jourFormate ?></h2>
                    <div class="heures">
                        <?php foreach ($heures as $heure) : ?>
                            <div class="cellule-heure" onclick="selectionnerHeure(this)">
                                <?= $heure ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <form action="index.php?ctrl=reservation&action=reserve" method="post" id="formulaireReservation">
            <input type="hidden" name="heure_selectionnee" id="heureSelectionnee">
            <button type="submit">Réserver</button>
        </form>
    <?php endif; ?>
</div>







<script>
function selectionnerHeure(celluleHeure) {
    // Réinitialiser la classe pour toutes les heures
    const toutesLesHeures = document.querySelectorAll('.cellule-heure');
    toutesLesHeures.forEach(cellule => {
        cellule.classList.remove('selectionnee');
    });

    // Appliquer la classe 'selectionnee' à la cellule cliquée
    celluleHeure.classList.add('selectionnee');

    // Mettre à jour la valeur de l'input caché avec l'heure sélectionnée
    const inputHeureSelectionnee = document.getElementById('heureSelectionnee');
    inputHeureSelectionnee.value = celluleHeure.textContent;
}
</script>
