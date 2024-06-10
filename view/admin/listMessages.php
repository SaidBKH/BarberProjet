<?php
$messages = $result["data"]['messages'];
?>

<h1>Boîte de réception</h1>

<?php if (isset($_SESSION['flash_message'])): ?>
    <div class="flash-message"><?php echo $_SESSION['flash_message']['message']; ?></div>
    <?php unset($_SESSION['flash_message']); ?>
<?php endif; ?>

<div class="inbox-container">
    <div class="message-list">
        <ul>
            <?php foreach ($messages as $message): ?>
                <li data-messageid="<?= $message->getId() ?>" class="message-item">
                    <?= htmlspecialchars($message->getCategoryContact()->getNameCategory()) ?><br>
                    <?= htmlspecialchars($message->getEmail()) ?><br>
                    <?= htmlspecialchars($message->getDateCreation()) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="message-detail">

    </div>
</div>


<script>


document.addEventListener('DOMContentLoaded', function() {
    const messageItems = document.querySelectorAll('.message-item');
    messageItems.forEach(item => {
        item.addEventListener('click', function() {
            const messageId = this.dataset.messageid;
            
            fetch(`?ctrl=admin&action=ajax&id=${messageId}`)
                .then(response => response.text())
                .then(data => {
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