<div class="registerPage">
    <figure class="logoContainer">
        <img src="public/img/logo.png" alt="Logo" class="logo">
    </figure>

    <h1>INSCRIPTION</h1>

    <form action="index.php?ctrl=security&action=register" method="post">
        <label for="prenom">Prénom :</label><br>
        <input placeholder="Prénom" type="text" id="prenom" name="prenom" required><br>

        <label for="email">Email :</label><br>
        <input placeholder="Email" type="email" id="email" name="email" required><br>

        <label for="password">Mot de passe :</label><br>
        <input placeholder="Mot de passe" type="password" id="password" name="password" required><br>

        <label for="confirm_password">Confirmer le mot de passe :</label><br>
        <input placeholder="Confirmer le mot de passe" type="password" id="confirm_password" name="confirm_password" required><br>

        <label for="telephone">Téléphone :</label><br>
        <input placeholder="Téléphone" type="tel" id="telephone" name="telephone" required><br>

        <button type="submit">S'inscrire</button>
    </form>
</div>
