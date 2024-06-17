<?php if (isset($message)): ?>
    <h2>Détails du message</h2>
    <p><strong>Catégorie :</strong> <?= htmlspecialchars($message->getCategoryContact()->getNameCategory()) ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($message->getEmail()) ?></p>
    <p><strong>Date de création :</strong> <?= htmlspecialchars($message->getDateCreation()) ?></p>
    <p><strong>Message :</strong> <?= nl2br(htmlspecialchars($message->getMessageContent())) ?></p>
<?php else: ?>
    <p>Aucun détail à afficher.</p>
<?php endif; ?>