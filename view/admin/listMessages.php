<?php
// Récupération des messages depuis le tableau $result
$messages = $result["data"]['messages'];
?>

<!-- Titre principal de la page -->
<h1 class="Titre Messagerie">Boîte de réception</h1>

<!-- Affichage d'un message flash s'il existe dans la session -->
<?php if (isset($_SESSION['flash_message'])): ?>
    <!-- Affichage du message flash -->
    <div class="flash-message"><?php echo $_SESSION['flash_message']['message']; ?></div>
    <!-- Suppression du message flash après l'affichage -->
    <?php unset($_SESSION['flash_message']); ?>
<?php endif; ?>

<!-- Formulaire pour supprimer les messages sélectionnés -->
<form method="post" action="?ctrl=admin&action=deleteMessages" id="deleteForm">
    <div class="inbox-container-message">
        <div class="message-list">
            <ul>
                <!-- Boucle sur les messages pour créer une liste d'éléments -->
                <?php foreach ($messages as $message): ?>
                    <li data-messageid="<?= $message->getId() ?>" class="message-item">
                        <!-- Case à cocher pour sélectionner le message -->
                        <input type="checkbox" name="messageIds[]" value="<?= $message->getId() ?>">
                        <!-- Affichage des détails du message -->
                        <?= htmlspecialchars($message->getCategoryContact()->getNameCategory()) ?><br>
                        <?= htmlspecialchars($message->getEmail()) ?><br>
                        <?= htmlspecialchars($message->getDateCreation()) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="message-detail"></div>
    </div>
    <!-- Bouton pour soumettre le formulaire et supprimer les messages sélectionnés -->
    <button type="submit" class="submit-message">Supprimer les messages sélectionnés</button>
</form>

<!-- Script JavaScript pour afficher les détails d'un message lorsqu'on clique dessus -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionne tous les éléments de message
    const messageItems = document.querySelectorAll('.message-item');
    
    // Ajoute un gestionnaire d'événements de clic pour chaque élément de message
    messageItems.forEach(item => {
        item.addEventListener('click', function() {
            // Récupère l'ID du message depuis l'attribut data-messageid
            const messageId = this.dataset.messageid;
            
            // Effectue une requête AJAX pour obtenir les détails du message
            fetch(`?ctrl=admin&action=ajax&id=${messageId}`)
                .then(response => response.text())
                .then(data => {
                    // Affiche les détails du message dans l'élément .message-detail
                    document.querySelector('.message-detail').innerHTML = data;
                });
        });
    });
});
</script>




























































<style>
    .inbox-container {
        display: flex;
    }
    .message-list {
        width: 30%;
        border-right: 1px solid #ccc;
        padding: 10px;
        overflow-y: auto;
    }
    .message-list ul {
        list-style: none;
        padding: 0;
    }
    .message-list li {
        padding: 10px;
        cursor: pointer;
    }
    .message-list li:hover {
        background-color: #f0f0f0;
    }
    .message-detail {
        width: 70%;
        padding: 10px;
    }
</style>