<!-- views/security/request_reset.php -->
<div class="request-reset">
    <h1>Réinitialiser votre mot de passe</h1>
    <form action="index.php?ctrl=security&action=requestReset" method="post">
        <label for="email">Email :</label><br>
        <input placeholder="Email" type="email" id="email" name="email" required><br>
        <button type="submit">Envoyer</button>
    </form>
</div>
