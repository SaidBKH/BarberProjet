<div class=" Page confirmationSuppression">
    <h1 class= "Titre">Confirmation de la suppression de compte</h1>
    <p>Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>
    <form action="index.php?ctrl=security&action=deleteAccount" method="POST">
        <input type="hidden" name="user_id" value="<?= App\Session::getUser()->getId() ?>">
        <button type="submit" class="btn-reservation">Oui, supprimer mon compte</button><br>
        <a href="index.php?ctrl=security&action=profile">Non, retourner à mon profil</a>
    </form>
</div>
