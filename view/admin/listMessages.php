<?php 
$messages = $result["data"]['messages'];
?>

<div class="listMessage">

    <h1>Messagerie</h1>

    <h2>Messages de Contact</h2>

    <?php if (!empty($result["data"]['messages'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date de Création</th>
                    <th>Catégorie</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                    <tr>
                        <td><?= htmlspecialchars($message->getNom()) ?></td>
                        <td><?= htmlspecialchars($message->getEmail()) ?></td>
                        <td><?= htmlspecialchars($message->getMessage()) ?></td>
                        <td><?= htmlspecialchars($message->getDateCreation()) ?></td>
                        <td><?= htmlspecialchars($message->getCategorieContact()) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun message trouvé.</p>
    <?php endif; ?>
</div>
