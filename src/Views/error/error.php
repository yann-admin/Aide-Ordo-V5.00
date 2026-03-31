<!--
 ***************************************************************************
 ****                    Application : Aide Ordo V4.00                  ****
 ****                    Auteur : MT Dev                                ****
 ****                    Date creation: 02/02/2026                      ****
 ****                    Date modification:                             ****
 *************************************************************************** -->



<!-- <?php if (isset($errorMessage)): ?>
    <div class="error">
        <?= htmlspecialchars($errorMessage) ?>
    </div>
<?php endif; ?> -->

<div class="d-flex justify-content-center align-items-center flex-column" style="height: 80vh;">
    <img src="App\public\assets\ImagesApp\error500.png" alt="error 500" class="img-fluid">
    <h1 class="mt-4">Oups ! Une erreur est survenue.</h1>
    <p class="text-center">Nous sommes désolés, mais une erreur inattendue s'est produite. Veuillez réessayer plus tard ou contacter le support si le problème persiste.</p>
    <a href="home" class="btn btn-primary mt-3">Retour à l'accueil</a>
    <?php if (isset($errorMessage)){ ?>
        <div class="error">
            <?= htmlspecialchars($errorMessage) ?>
        </div>
    <?php } ?>
</div>