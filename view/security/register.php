
<div class="registerPage">
    <br>
    <h1>INSCRIPTION</h1>
    <br> 
    
        <form action="index.php?ctrl=security&action=register" method="post">
            <label for="prenom">Prénom :</label><br>
            <input placeholder="prenom" type="text" id="prenom" name="prenom" required style="text-align: center;"><br>

            <label for="email">Email :</label><br>
            <input placeholder= email type="email" id="email" name="email" required style="text-align: center;"><br>

            <label for="password">Mot de passe :</label><br>
            <input placeholder="mot de passe" type="password" id="password" name="password" required style="text-align: center;"><br>

            <label for="confirm_password">Confirmer le mot de passe :</label><br>
            <input placeholder="mot de passe" type="password" id="confirm_password" name="confirm_password" required style="text-align: center;"><br>

            <label for="telephone">telephone</label><br>
            <input placeholder="telephone" type="telephone" id="telephone" name="telephone" required style="text-align: center;"><br>

            <button type="submit">S'inscrire</button>
        </form>
</div>
