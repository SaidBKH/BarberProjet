<?php
$categories = $result["data"]['categories'];
$services = $result["data"]['services'];
$message = $result["data"]['message'];
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Créer un creneau</h1>
    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>


    <form method="post" action="">
        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <select id="categorie" name="categorie_id" class="form-control" onchange="this.form.submit()">
                <option value="">Sélectionner une catégorie</option>
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie->getId() ?>" <?= isset($_POST['categorie_id']) && $_POST['categorie_id'] == $categorie->getId() ? 'selected' : '' ?>><?= htmlspecialchars($categorie->getNomCategorie()) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="service">Service</label>
            <select id="service" name="service_id" class="form-control" <?= empty($services) ? 'disabled' : '' ?>>
                <option value="">Sélectionner un service</option>
                <?php foreach ($services as $service): ?>
                    <option value="<?= $service->getId() ?>"><?= htmlspecialchars($service->getNom()) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>">
        </div>

        <div class="form-group">
            <label for="heure">Heure</label>
            <input type="time" id="heure" name="heure" class="form-control" step="1">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Créer Réservation</button>
    </form>
</div>
