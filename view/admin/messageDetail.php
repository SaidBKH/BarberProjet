<?php
$message = $result["data"]['message'];
?>

<?php if (isset($message)): ?>
    <h2>Message de <?= htmlspecialchars($message->getName()) ?></h2>
    <p><strong>Email:</strong> <?= htmlspecialchars($message->getEmail()) ?></p>
    <p><strong>Date:</strong> <?= htmlspecialchars($message->getDateCreation()) ?></p>
    <p><strong>Catégorie:</strong> <?= htmlspecialchars($message->getCategoryContact()->getNameCategory()) ?></p>
    <p><?= nl2br(htmlspecialchars($message->getMessage())) ?></p>


    <h3>Répondre au message</h3>
    <form action="?ctrl=admin&action=sendResponse" method="post">
        <input type="hidden" name="email" value="<?= htmlspecialchars($message->getEmail()) ?>">
        <input type="hidden" name="name" value="<?= htmlspecialchars($message->getName()) ?>">
        <textarea name="response" rows="4" placeholder="Votre réponse"></textarea>
        <input type="submit" value="Envoyer">
    </form>
<?php else: ?>
    <p>Message non trouvé.</p>
<?php endif; ?>
