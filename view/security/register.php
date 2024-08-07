<div class="Page registerPage">
    <figure class="logoContainer">
        <img src="public/img/logo.webp" alt="Logo" class="logo">
    </figure>

    <h1>INSCRIPTION</h1>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="flash-message"><?php echo $_SESSION['flash_message']; ?></div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

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

        <button type="submit" class="btn-reservation">S'inscrire</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var input = document.querySelector("#telephone");
    window.intlTelInput(input, {
        initialCountry: "fr",
        preferredCountries: ["fr", "ch", "it", "de"],
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });
});
</script>

