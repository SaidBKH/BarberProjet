<div class="loginPage">
    <figure class="logoContainer">
        <img src="public/img/logo.png" alt="Logo" class="logo">
    </figure>
        
    <form action="index.php?ctrl=security&action=login" method="post">
        <label for="email"></label><br>
        <input placeholder="Adresse e-mail" type="email" id="email" name="email" required><br>
        
        <label for="password"></label><br>    
        <input placeholder="Mot de passe" type="password" id="password" name="password" required><br>
        
        <button type="submit">Se connecter</button>
    </form>
    
    <p>Vous n'avez pas encore de compte ?</p>
    <br>
    <button name="register">
        <a href="index.php?ctrl=security&action=register">JE M'INSCRIS</a>
    </button>


</div>



