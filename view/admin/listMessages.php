<?php
$messages = $result["data"]['messages'];
?>

<h1>Liste des Messages de Contact</h1>


<?php foreach ($messages as $message): ?> 
    <tr>
        <td><?= $message->getId() ?></td>
        <td><?= $message->getName() ?></td>
        <td><?= $message->getEmail() ?></td>
        <td><?= $message->getMessage() ?></td>
        <td><?= $message->getDateCreation() ?></td>
    </tr>
<?php endforeach; ?>
