<?php
setlocale(LC_TIME, 'fr_FR.UTF-8'); // Configure la localisation en français pour la gestion des dates et heures

// Récupération des catégories et services depuis le résultat
$categorys = $result["data"]['categorys']; // Récupère la liste des catégories de services
$services = $result["data"]['services']; // Récupère la liste des services disponibles
?>

<div class="container mt-5">
    <!-- Titre principal -->
    <h1 class="Titre">Créer des créneaux</h1> <!-- Affiche le titre de la page -->

    <!-- Message flash en cas de succès/échec -->
    <?php if (isset($_SESSION['flash_message'])): ?> <!-- Vérifie s'il y a un message flash dans la session -->
        <div class="flash-message"><?php echo $_SESSION['flash_message']; ?></div> <!-- Affiche le message flash -->
        <?php unset($_SESSION['flash_message']); ?> <!-- Supprime le message flash de la session après l'affichage -->
    <?php endif; ?>

    <!-- Formulaire principal -->
    <form method="post" action="">
        <!-- Sélection de la catégorie -->
        <div class="form-group">
            <label for="category">Catégorie</label> <!-- Label pour le champ de sélection de la catégorie -->
            <select id="category" name="category_id" class="form-control" onchange="this.form.submit()">
                <option value="">Sélectionner une catégorie</option> <!-- Option par défaut pour inviter à sélectionner une catégorie -->
                <?php foreach ($categorys as $category): ?> <!-- Boucle pour afficher toutes les catégories -->
                    <option value="<?= $category->getId() ?>" <?= isset($_POST['category_id']) && $_POST['category_id'] == $category->getId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category->getCategoryName()) ?>
                    </option> <!-- Affiche chaque catégorie en tant qu'option dans le menu déroulant -->
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Sélection du service -->
        <div class="form-group">
            <label for="service">Service</label> <!-- Label pour le champ de sélection du service -->
            <select id="service" name="service_id" class="form-control" <?= empty($services) ? 'disabled' : '' ?>>
                <option value="">Sélectionner un service</option> <!-- Option par défaut pour inviter à sélectionner un service -->
                <?php foreach ($services as $service): ?> <!-- Boucle pour afficher tous les services disponibles -->
                    <option value="<?= $service->getId() ?>"><?= htmlspecialchars($service->getName()) ?></option> <!-- Affiche chaque service en tant qu'option dans le menu déroulant -->
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Sélection des dates -->
        <div class="form-group">
            <label for="dates">Dates</label> <!-- Label pour le groupe de dates -->
            <div id="dates" class="d-flex flex-wrap">
                <?php
                $currentDate = new DateTime(); // Crée un objet DateTime pour la date actuelle
                $endDate = new DateTime(); // Crée un objet DateTime pour la date de fin
                $endDate->modify('+14 days'); // Définit la date de fin à 14 jours après la date actuelle

                while ($currentDate <= $endDate) { // Boucle à travers les dates de la date actuelle à la date de fin
                    // Ne pas afficher les dimanches
                    if ($currentDate->format('N') != 7) { // Vérifie si la date n'est pas un dimanche
                        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE); // Crée un formateur pour la date
                        echo '<div class="form-check mr-3">';  // Affiche un div pour chaque date avec espacement
                        echo '<input class="form-check-input date-checkbox" type="checkbox" name="dates[]" value="' . $currentDate->format('Y-m-d') . '" id="date_' . $currentDate->format('Y_m_d') . '">';
                        echo '<label class="form-check-label date-label" for="date_' . $currentDate->format('Y_m_d') . '">' . $formatter->format($currentDate->getTimestamp()) . '</label>';
                        echo '</div>';
                    }
                    $currentDate->modify('+1 day'); // Passe à la date suivante
                }
                ?>
            </div>
        </div>

        <!-- Sélection des plages horaires -->
        <div class="form-group">
            <label for="heures">Plages horaires</label> <!-- Label pour le groupe d'heures -->
            <div id="heures" class="d-flex flex-wrap">
                <?php
                $start = new DateTime('09:00'); // Crée un objet DateTime pour l'heure de début
                $end = new DateTime('19:00'); // Crée un objet DateTime pour l'heure de fin
                $interval = new DateInterval('PT30M'); // Définit un intervalle de 30 minutes

                while ($start < $end) { // Boucle à travers les plages horaires
                    if ($start->format('H:i') !== '12:00' && $start->format('H:i') !== '12:30') { // Ignore l'heure de déjeuner
                        echo '<div class="form-check mr-3">';  // Affiche un div pour chaque plage horaire avec espacement
                        echo '<input class="form-check-input heure-checkbox" type="checkbox" name="heures[]" value="' . $start->format('H:i:s') . '" id="heure_' . $start->format('H_i') . '">';
                        echo '<label class="form-check-label heure-label" for="heure_' . $start->format('H_i') . '">' . $start->format('H:i') . '</label>';
                        echo '</div>';
                    }
                    $start->add($interval); // Passe à l'heure suivante en ajoutant l'intervalle
                }
                ?>
            </div>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary mt-3">Créer Réservations</button> <!-- Bouton pour soumettre le formulaire -->
    </form>
</div>
