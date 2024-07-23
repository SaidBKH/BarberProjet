<div class="Page Modifier MotDePasse">
<h2 class ="titre">Modifier votre mot de passe</h2>
<form action="index.php?ctrl=security&action=editPassword" method="POST">
    <div>
        <label for="old_password">Ancien mot de passe</label>
        <input type="password" name="old_password" required>
    </div>
    <div>
        <label for="new_password">Nouveau mot de passe</label>
        <input type="password" name="new_password" required>
    </div>
    <div>
        <label for="confirm_new_password">Confirmer le nouveau mot de passe</label>
        <input type="password" name="confirm_new_password" required>
    </div>
    <div>
        <button type="submit"class ="btn-reservation">Modifier le mot de passe</button>
    </div>
</form>
</div>