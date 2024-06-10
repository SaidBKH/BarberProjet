<?php
$messages = $result["data"]['messages'];
// $category = $result["data"]['category'];



?>

<h1>Liste des Messages</h1>

<table border="1">
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
                <td><?= htmlspecialchars($message->getName()) ?></td>
                <td><?= htmlspecialchars($message->getEmail()) ?></td>
                <td><?= $message->getMessage() ?></td>
                <td><?= htmlspecialchars($message->getDateCreation()) ?></td>
                <td><?= htmlspecialchars($message->getCategoryContact()->getNameCategory()) ?></td>
            
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

