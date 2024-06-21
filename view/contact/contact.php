<?php $categorys = $result["data"]['categorys']; ?>

<div class="Page page-contact">
    <h1 class="Titre">Contactez-nous</h1>
    
    <p>Vous pouvez nous contacter de différentes manières :</p>
    <ul>
        <li>Par téléphone au : 04 50 75 03 39</li>
        <li>En visitant notre salon à l'adresse : 1 All. François Truffaut, 74100 Annemasse</li>
        <li>En remplissant le formulaire ci-dessous</li>
    </ul>
    
    <form action="" method="post" class="contact-form">
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" placeholder="Votre nom" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Votre email" required>
        </div>
        
        <div class="form-group">
            <label for="category">Catégorie de Message :</label>
            <select id="category" name="category" required>
                <option value="">Choisissez une catégorie</option>
                <?php foreach($categorys as $category): ?>
                    <option value="<?= $category->getId() ?>">
                        <?= htmlspecialchars($category->getNameCategory())?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="message">Message :</label>
            <textarea id="message" name="message" rows="4" placeholder="Saisissez votre message ici..." required></textarea>
        </div>
        
        <input type="submit" value="Envoyer" class="btn-submit">
    </form>

    <p> Tous les champs sont obligatoires.</p>
</div>

