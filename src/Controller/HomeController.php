<?php
    declare(strict_types=1);
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
        # Config → contient juste des données / Configurations
        # Builder → construit
        # Manager → gère
        # Renderer → affiche / génère le rendu
        # Factory → crée
        # Service → fournit une logique métier
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
        namespace App\src\Controller;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
        # Throwable for catch all errors and exceptions
        use \Throwable;

        # Class Controllers
        use App\src\Controller\Controller;





    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class HomeController extends Controller{
                /* ▂ ▅ Constants ▅ ▂ */
                    private const ERROR_HOME = "Error in home: ";
                    private const NOT_FOUND = "404 - Page not found";
                /* ▂▂▂▂▂▂▂▂▂▂▂ */

                /* ▂ ▅ Attributs ▅ ▂ */
                /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

                /* ▂ ▅ Methodes ▅ ▂ */

                    /* ▂ ▅ Constructor ▅ ▂ */
                    public function __construct() {
                        # We call the parent constructor to initialize the headConfig and navMenuConfig attributes
                        parent::__construct();
                    }

                    /* ▂ ▅  index()  ▅ ▂ */
                    public function index() : void{

                        $this->authRedirect->requireAuthentication();

                        try {
                            # Display the home/index.php view with the header configuration; the head is read in the controller's render method.
                            $this->render('home/index', []);

                        } catch ( Throwable $e ) {
                            error_log( self::ERROR_HOME . $e->getMessage() . "\n" . $e->getTraceAsString() );
                            # Render the view error/error.php with the error message
                            $this->render('error/error', ['errorMessage' => self::ERROR_HOME]);
                        }
                    }

                    public function error() : void {
                        try {
                            # Display the home/index.php view with the header configuration; the head is read in the controller's render method.
                            $this->render('error/error', ['errorMessage' => self::NOT_FOUND]);

                        } catch ( Throwable $e ) {
                            error_log( self::ERROR_HOME . $e->getMessage() . "\n" . $e->getTraceAsString() );
                            # Render the view error/error.php with the error message
                            $this->render('error/error', ['errorMessage' => self::ERROR_HOME]);
                        }
                    }



            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>
