<div class="page_edit_profile">
    <h2>Modifier mon profil</h2>
    <form action="index.php?ctrl=security&action=editProfile" method="post">
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars(App\Session::getUser()->getPrenom()) ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars(App\Session::getUser()->getEmail()) ?>" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone :</label>
            <input type="text" id="telephone" name="telephone" value="<?= htmlspecialchars(App\Session::getUser()->getTelephone()) ?>" required>
        </div>
        <button type="submit">Enregistrer</button>
    </form>
</div>
