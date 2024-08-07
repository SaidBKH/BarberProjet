<div class="container-create-news">
        <div class="create-news">
            <h1 class="Titre">Créer une actualité</h1>
            <form method="post" action="">
                <div class="form-group-news">
                    <label for="title">Titre</label>
                    <input type="text" id="titre" name="title" class="form-control" required>
                </div>
                <div class="form-group-news">
                    <label for="photo">URL de la photo</label>
                    <input type="text" id="photo" name="photo" class="form-control" required>
                </div>
                <div class="form-group-news">
                    <label for="text">Texte</label>
                    <textarea id="texte" name="text" class="form-control" rows="5" required></textarea>
                </div>
                <div class="form-group-news">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <button type="submit" class="btn-reservation">Créer Actualité</button>
            </form>
        </div>
    </div>
