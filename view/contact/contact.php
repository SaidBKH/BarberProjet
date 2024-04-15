<div class="PageContact">

<h1>Contactez-nous</h1>
    
    <p>Vous pouvez nous contacter de différentes manières :</p>
    <ul>
        <li>Par téléphone au : 04 50 75 03 39</li>
        <li>En visitant notre salon à l'adresse : 1 All. François Truffaut, 74100 Annemasse</li>
        <li>En remplissant le formulaire ci-dessous</li>
    </ul>
    
    <form action="submit_contact.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="categorie">Catégorie de Message :</label>
        <select id="categorie" name="categorie" required>
            <option value="Informations">Demande d'Informations</option>
            <option value="Réclamations">Réclamations</option>
            <option value="Autre">Autre</option>
        </select><br><br>
        
        <label for="message">Message :</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br><br>
        
        <input type="submit" value="Envoyer">
    </form>

</div>