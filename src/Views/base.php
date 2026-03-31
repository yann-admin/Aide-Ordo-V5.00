<!-- **********************************************************************
****                    Titre: Aide-Ordo                               ****
****                    Author: Yann Martin                            ****
****                    Version: 5.00                                  ****
****                    Date creation: 02/02/2026                      ****
****                    Date modification:                             ****
*************************************************************************** -->


<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Affichage dynamique des balises meta, du titre, des liens vers les fichiers CSS et JS -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, height=device-height">

        <meta name="keywords" content="<?= $head->getKeywords() ?>">

        <meta name="description" content="<?= $head->getDescription() ?>">

        <meta name="author" content="<?= $head->getAuthor() ?>">

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?= $head->getFavicon() ?>" type="image/x-icon">
        <title> <?= $head->getTitle() ?> </title>

        <!-- Link to  styles fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Maven Pro">

        <!--Links to icons  -->
        <script src="https://kit.fontawesome.com/a9862965ca.js" crossorigin="anonymous"></script>

        <!-- Link to modale sweetalert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- BOOTSTRAP -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

        <!-- Initial Css -->
        <link rel="stylesheet" href="<?= $head->getInitialCss() ?>">

        <!-- Initial Js -->
        <script type="module" src="<?= $head->getInitialJs() ?>"></script>

        <!-- Additional CSS -->
        <?php foreach ($head->getAdditionalCss() as $css) : ?>
            <link rel="stylesheet" href="<?= $css ?>">
        <?php endforeach; ?>

            <!-- Additional JS -->
            <?php foreach ($head->getAdditionalJs() as $js) : ?>
            <script type="module" src="<?= $js ?>"></script>
        <?php endforeach; ?>

        <!-- ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  -->

    </head>

<!--
Memo
    container: Notre classe par défaut est un conteneur réactif à largeur fixe, c’est-à-dire qu’il change à chaque point d’arrêt.
    container-fluid: Utilisez pour un conteneur pleine largeur, couvrant toute la largeur de la fenêtre de vue.

xs => <576px
sm => ≥576px
md => ≥768px
lg => ≥992PX
xl => ≥1200px
xxl => ≥1400px

-->

    <body>
        <!-- ▂ ▅ ▆ █   Loading  █ ▆ ▅ ▂ -->
            <div id='loader' class="container-loader visibilityHidden" >
                <div class="spinner-container">
                    <div class="spinner">
                        <div class="spinner-ring spinner-ring-1"></div>
                        <div class="spinner-ring spinner-ring-2"></div>
                        <div class="spinner-ring spinner-ring-3"></div>
                        <div class="spinner-center">
                            <div class="spinner-icon"> </div>
                        </div>
                    </div>
                </div>
                <div class="message-container">
                    <div class="status" id="status">  </div>
                </div>
            </div>
        <!-- ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ -->

        <!-- ▂ ▅ ▆ █   HEADER  █ ▆ ▅ ▂ -->
        <header class="container-fluid header">
            <nav class="navbar ">
                <div class="container-fluid">
                <button class="navbar-toggler " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span> <img src="assets/ImagesApp/LogoChichoune50x50.png" alt="" class="img-fluid rounded-circle"> </span>
                </button>

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Api - Chichoune</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>

                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <?= $menuHtml ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </nav>
            <!-- nav charger!!!! -->
        </header>
        <!-- ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ -->
      
        <!-- ▂ ▅ ▆ █   MAIN  █ ▆ ▅ ▂ -->
        <main class="container-fluid align-content-center p-0 ">
            <div class="d-flex justify-content-center mb-2 row">
                    <!-- Affichage dynamique de la variable $content -->
                    <?= $content ?>
            </div>
        </main>
        <!-- ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ -->

        <!-- ▂ ▅ ▆ █   FOOTER  █ ▆ ▅ ▂ -->
        <footer class="container-fluid justify-content-center align-content-center">
                <div class="d-flex flex-row">
                    <div class="col d-flex  justify-content-center align-items-center colLeftFooter">
                        <img class='img-fluid logoMt' src="assets/ImagesApp/LogoMT.png" alt="Logo de l'entreprise MT Sofware Development">
                    </div>

                    <div class="col-8 d-flex justify-content-center align-items-center colMiddleFooter">
                        <p class="text-center">© 2026 Aide-Ordo - Tous droits réservés. Conçu et développé par MT-Dev: Yann MARTIN</p>
                    </div>

                    <div class="col-2 d-flex justify-content-center align-items-center colRightFooter">
                    
                    </div>
                </div>
        </footer>
        <!-- ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ -->

        <!-- ▂ ▅ ▆ █ BOOTSTRAP █ ▆ ▅ ▂ -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
        <!-- ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ -->
    </body>
    <!-- End body -->

</html>
