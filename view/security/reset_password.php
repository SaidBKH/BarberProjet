<!-- views/security/reset_password.php -->
<div class="reset-password">
    <h1>Réinitialiser votre mot de passe</h1>
    <form action="index.php?ctrl=security&action=resetPassword" method="post">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        <label for="password">Nouveau mot de passe :</label><br>
        <input placeholder="Mot de passe" type="password" id="password" name="password" required><br>
        <label for="confirm_password">Confirmer le mot de passe :</label><br>
        <input placeholder="Confirmer le mot de passe" type="password" id="confirm_password" name="confirm_password" required><br>
        <button type="submit">Réinitialiser</button>
    </form>
</div>
