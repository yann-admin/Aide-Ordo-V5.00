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

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        namespace App\src\Controller;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

        # Class HeadConfig
        use App\config\HeadConfig;

        # Class MenuBuilder
        use App\src\Core\Menu\MenuBuilder;
        # Class MenuRenderer
        use App\src\Renderer\MenuRenderer;

        /* *********** OBLIGATORY *********** */
            # Class SessionManager
            use App\src\Core\Session\SessionManager;
            # OBLIGATORY Class AuthenticationRedirect for all controllers to protect the routes
            use App\src\Core\AuthenticationRedirect;
        /* ********************************** */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
            abstract class Controller{

                /* ▂ ▅ Constants ▅ ▂ */
                /* ▂▂▂▂▂▂▂▂▂▂▂ */

                /* ▂ ▅ Attributs ▅ ▂ */
                    protected HeadConfig $headConfig;
                    protected AuthenticationRedirect $authRedirect;
                /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

                /* ▂ ▅ Methodes ▅ ▂ */

                    /*  ▂ ▅ ▆ █ Constructor █ ▆ ▅ ▂ */
                    public function __construct( ) {
                        # We initialize the headConfig attribute with a new instance of the HeadConfig class
                            $this->headConfig = new HeadConfig();
   
                        /* *********** OBLIGATORY *********** */
                            # We initialize the AuthenticationRedirect attribute with a new instance of the AuthenticationRedirect class, passing the SessionManager instance to its constructor
                            $this->authRedirect = new AuthenticationRedirect(new SessionManager());
                        /* ********************************** */

                    }

                    /*  ▂ ▅ ▆ █ Render( ) █ ▆ ▅ ▂ */
                    /** @param string $patch : le chemin de la vue à inclure (ex: 'home/index' pour App/Views/home/index.php) */
                    /** @param array $data : les données à extraire pour la vue (ex: ['navMenu'=>$navMenu, 'head'=>$head] ) */
                    public function render(string $path, ?array $data = null) : void {
                        # On instancie la classe HeadConfig et on hydrate ses propriétés avec les données du tableau $data['head'] si elles existent
                        $head = $this->headConfig;
                        
                        # We build the menu using the MenuBuilder class and render it using the MenuRenderer class, passing the user's access level obtained from the AuthenticationRedirect instance to determine which menu items to display based on the user's permissions.
                        $menu = MenuBuilder::buildMenu();

                        # We create a new instance of the MenuRenderer class, which will be responsible for rendering the menu based on the user's access level and the menu structure defined in the MenuBuilder class.
                        $renderer = new MenuRenderer();

                        # We call the render method of the MenuRenderer instance, passing in the menu structure and the user's access level obtained from the AuthenticationRedirect instance. This will generate the HTML for the menu based on the user's permissions and the defined menu structure.
                        $menuHtml = $renderer->render($menu, $this->authRedirect->getUserLevel());

                        # On extrait les données du tableau $data pour les rendre disponibles sous forme de variables dans la vue
                        extract($data);
                        # on créer le buffer de sortie:
                        ob_start();
                        # Créer le chemin et inclut le fichier de la vue souhaitée
                        $viewPath =  dirname(__DIR__). '/Views/' . $path . '.php';
                        require $viewPath;
                        # On Vide le buffer dans la variable $content
                        $content = ob_get_clean();
                        # On fabrique le "template"
                        require dirname(__DIR__) .'/Views/base.php';
                    }

                    /* ▂ ▅ ▆ █  Redirect  █ ▆ ▅ ▂  */
                    /** @param string $url : l'URL vers laquelle rediriger */
                    protected function redirect(string $url) : void {
                        header('Location: ' . $url);
                        exit();
                    }
                    
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

?>
