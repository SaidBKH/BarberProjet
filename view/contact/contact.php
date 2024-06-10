<?php $categorys = $result["data"]['categorys']; ?>

<div class="PageContact">
    <h1>Contactez-nous</h1>
    
    <p>Vous pouvez nous contacter de différentes manières :</p>
    <ul>
        <li>Par téléphone au : 04 50 75 03 39</li>
        <li>En visitant notre salon à l'adresse : 1 All. François Truffaut, 74100 Annemasse</li>
        <li>En remplissant le formulaire ci-dessous</li>
    </ul>
    
    <form action="" method="post">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="category">Catégorie de Message :</label>
        <select id="category" name="category" required>
            <option value="">Choisissez une catégorie</option>
            <?php foreach($categorys as $category): ?>
                <option value="<?= $category->getId() ?>">
                    <?= htmlspecialchars($category->getNameCategory())?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        
        <label for="message">Message :</label><br>
        <textarea id="message" name="message" rows="4" required placeholder="Saisissez votre message ici..."></textarea><br><br>
        
        <input type="submit" value="Envoyer">
    </form>

    <p style="font-style: italic; color: #999;">Tous les champs sont obligatoires.</p>
</div>
