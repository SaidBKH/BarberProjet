<?php
setlocale(LC_TIME, 'fr_FR.UTF-8');

$categorys = $result["data"]['categorys'];
$services = $result["data"]['services'];
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Créer des créneaux</h1>


    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="flash-message"><?php echo $_SESSION['flash_message']; ?></div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>


    <form method="post" action="">
        <div class="form-group">
            <label for="category">Catégorie</label>
            <select id="category" name="category_id" class="form-control" onchange="this.form.submit()">
                <option value="">Sélectionner une catégorie</option>
                <?php foreach ($categorys as $category): ?>
                    <option value="<?= $category->getId() ?>" <?= isset($_POST['category_id']) && $_POST['category_id'] == $category->getId() ? 'selected' : '' ?>><?= htmlspecialchars($category->getCategoryName()) ?></option>
                <?php endforeach; ?>
            </select>
        </div>


        <div class="form-group">
            <label for="service">Service</label>
            <select id="service" name="service_id" class="form-control" <?= empty($services) ? 'disabled' : '' ?>>
                <option value="">Sélectionner un service</option>
                <?php foreach ($services as $service): ?>
                    <option value="<?= $service->getId() ?>"><?= htmlspecialchars($service->getName()) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        
        
        <div class="form-group">
            <label for="dates">Dates</label>
            <div id="dates" class="d-flex flex-wrap">
                <?php
                $currentDate = new DateTime();
                $endDate = new DateTime();
                $endDate->modify('+14 days');

                while ($currentDate <= $endDate) {
                    // Ne pas afficher les dimanches
                    if ($currentDate->format('N') != 7) {
                        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input date-checkbox" type="checkbox" name="dates[]" value="' . $currentDate->format('Y-m-d') . '" id="date_' . $currentDate->format('Y_m_d') . '">';
                        echo '<label class="form-check-label date-label" for="date_' . $currentDate->format('Y_m_d') . '">' . $formatter->format($currentDate->getTimestamp()) . '</label>';
                        echo '</div>';
                    }
                    $currentDate->modify('+1 day');
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="heures">Plages horaires</label>
            <div id="heures" class="d-flex flex-wrap">
                <?php
                $start = new DateTime('09:00');
                $end = new DateTime('19:00');
                $interval = new DateInterval('PT30M');

                while ($start < $end) {
                    if ($start->format('H:i') !== '12:00' && $start->format('H:i') !== '12:30') {
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input heure-checkbox" type="checkbox" name="heures[]" value="' . $start->format('H:i:s') . '" id="heure_' . $start->format('H_i') . '">';
                        echo '<label class="form-check-label heure-label" for="heure_' . $start->format('H_i') . '">' . $start->format('H:i') . '</label>';
                        echo '</div>';
                    }
                    $start->add($interval);
                }
                ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Créer Réservations</button>
    </form>
</div>
