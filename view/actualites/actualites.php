
<?php
        $publications = $result["data"]['publications']; 
    ?>

    <div class="actualites">
        
        <?php foreach ($publications as $publication) : ?>
            <img src="<?=$publication->getPhoto()  ?>" alt="actualités-images"><?=$publication->getTexte()  ?>
                    <?php endforeach; ?>
    </div>

      