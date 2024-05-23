<div class="container mt-5">
    <h1 class="text-center mb-4">Créer une actualité</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="photo">URL de la photo</label>
            <input type="text" id="photo" name="photo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="texte">Texte</label>
            <textarea id="texte" name="texte" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Créer Actualité</button>
    </form>
</div>
