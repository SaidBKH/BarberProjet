<div class=" Page page_profil">

<div class="nom">
        <p>
            <strong>Nom :</strong> <?= htmlspecialchars(App\Session::getUser()->getPrenom()) ?>
            <a href="index.php?ctrl=security&action=editProfile" class="btn-simple-modifier">Modifier</a>
        </p>
    </div>
    <div class="email">
        <p>
            <strong>Email :</strong> <?= htmlspecialchars(App\Session::getUser()->getEmail()) ?>
            <a href="index.php?ctrl=security&action=editProfile" class="btn-simple-modifier">Modifier</a>
        </p>
    </div>
    <div class="telephone">
        <p>
            <strong>Téléphone :</strong> <?= htmlspecialchars(App\Session::getUser()->getTelephone()) ?>
            <a href="index.php?ctrl=security&action=editProfile class="btn-simple-modifier"">Modifier</a>
        </p>

        <a href="index.php?ctrl=security&action=editPassword" class="btn-simple-modifier">Modifier votre mot de passe</a>

    </div>

    <div class="deleteAccount">
        <form action="index.php?ctrl=security&action=confirmDeleteAccount" method="POST">
            <button type="submit" class="btn-simple" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">Supprimer mon compte</button>
        </form>
    </div


    <div class="dateInscription">
        <p>
            <strong>Membre depuis le :</strong>
            <?php 
            // Récupérer la date de création de l'utilisateur
            $creationDate = App\Session::getUser()->getCreationDate();

            // Formater la date au format "jour mois année"
            $formattedDate = date('j/m/Y', strtotime($creationDate));

            // Afficher la date formatée
            echo htmlspecialchars($formattedDate);
            ?>
        </p>
    </div>
    
    <div class="listeReservationClient">
        <h3>Mes Réservations</h3>
        <?php if (empty($result["data"]["reservations"])): ?>
            <p>Aucune réservation.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($result["data"]["reservations"] as $reservation): ?>
                    <li>
                        <strong>Date :</strong> <?= htmlspecialchars($reservation->getDate()) ?><br>
                        <strong>Heure :</strong> <?= htmlspecialchars($reservation->getHeure()) ?><br>
                        <strong>Service :</strong> <?= htmlspecialchars($reservation->getService()->getName()) ?>
                        <form method="post" action="index.php?ctrl=reservation&action=AnnulerReservation">
                            <input type="hidden" name="reservation_id" value="<?= $reservation->getId() ?>">
                            <button type="submit">Annuler</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
