<!-- forgot_password.php -->
<div class="forgotPasswordPage">
    <h2>Mot de passe oublié</h2>
    <form action="index.php?ctrl=security&action=forgotPassword" method="post">
        <label for="email">Entrez votre adresse e-mail :</label><br>
        <input type="email" id="email" name="email" required><br>
        <button type="submit">Envoyer</button>
    </form>
</div>
