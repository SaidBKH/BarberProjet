<div class="page_profil">
    <h2>Modifier le profil</h2>

    <form action="index.php?ctrl=security&action=updateProfile" method="post">
        <input type="hidden" name="field" value="<?= htmlspecialchars($data['field']) ?>">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($data['user']->getId()) ?>">

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($data['user']->getPrenom()) ?>"><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['user']->getEmail()) ?>"><br>

        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" value="<?= htmlspecialchars($data['user']->getTelephone()) ?>"><br>

        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>
