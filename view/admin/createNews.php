<div class=" Page container mt-5">
    <h1 class="Titre text-center mb-4">Créer une actualité</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" id="titre" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="photo">URL de la photo</label>
            <input type="text" id="photo" name="photo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="text">Texte</label>
            <textarea id="texte" name="text" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Créer Actualité</button>
    </form>
</div>
