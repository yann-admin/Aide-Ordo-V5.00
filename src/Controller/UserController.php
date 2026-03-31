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

        /* *********** OBLIGATORY *********** */
            # We include the Abstract Controller class to extend it in the UserController class
            use App\src\Controller\Controller;
            # We include the FormRenderer class to render the form in HTML
            use App\src\Renderer\FormRenderer;
            # We include the Static Response class to handle HTTP responses
            use App\src\Service\Http\Response;
            # We include the Static Validator class to validate the user input
            use App\src\Form\FormValidator;
            # We include the Static MessageConfig class to get the messages for the application
            use App\src\Service\Config\MessageConfig;

        /* ********************************** */


        # We include the FormLoginBuilder class to build the login form, extends Form
        use App\src\Form\Builder\FormLoginBuilder;
        # We include the FormLoginConfig class to get the configuration for the login form
        use App\src\Form\Config\FormLoginConfig;
        # We include the UserManager class to handle the user data and authentication logic
        use App\src\Manager\UserManager;
        # We include the SessionManager class to handle the session management and user authentication state
        use App\src\Core\Session\SessionManager;
        # OBLIGATORY Class AuthenticationRedirect for all controllers to protect the routes
        use App\src\Core\AuthenticationRedirect;


    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class UserController extends Controller{

            /* ▂ ▅ Constants ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */
                private FormLoginBuilder $formLoginBuilder;
                private MessageConfig $messageConfig;
                private array $inputsConfig;
                private SessionManager $sessionManager;
            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅  __construct() ▅ ▂ */
                    public function __construct(){
                        # We call the parent constructor to initialize the headConfig and navMenuConfig attributes and the authRedirect attribute
                        parent::__construct();
                        # We initialize the formLoginBuilder attribute with a new instance of the FormLoginBuilder class
                        $this->formLoginBuilder = new FormLoginBuilder();
                        # We set the configuration for the login form using the FormLoginConfig class
                        $this->inputsConfig = FormLoginConfig::getLoginFormConfig();
                        # We initialize the session manager attribute with a new instance of the SessionManager class
                        $this->sessionManager = new SessionManager();

                    }

                /* ▂ ▅  index() ▅ ▂ */
                /** @return void */
                public function index() : void{
                    # We control access to the page with the AuthenticationRedirect class
                    $this->authRedirect->ifAuthenticated();

                    # We build the login form using the build() method of the formLoginBuilder class and store it in the $loginForm variable
                    $form = $this->formLoginBuilder->build( $this->inputsConfig );
                    # We render the login form using the renderV2() static method of the FormRenderer class and store the resulting HTML in the $loginFormView variable
                    $formHtml = FormRenderer::renderV2 ($form );
                    # We set the head configuration for the view
                    $this->headConfig->setTitle('Login');
                    $this->headConfig->setDescription('Login page');
                    $this->headConfig->setKeywords('login, user, authentication');
                    $this->headConfig->addAdditionalCss('App/public/assets/css/form.css');
                    $this->headConfig->addAdditionalJs('App/public/assets/js/login.js');
                    # We render the login view
                    $this->render ('user/login', ['htmlForm' => $formHtml]);
                }

                /* ▂ ▅  logout() ▅ ▂ */
                public function logout() : void {
                    # We destroy the session and redirect to the login page
                    $this->sessionManager->destroySession();
                    # We redirect to the login page
                    $this->redirect('login');
                }

                /* ▂ ▅  login() ▅ ▂ */
                /** @return void */
                public function login( ) : void{
                    $backUrl = 'login';
                    # We validate the form data using the validate() static method of the FormValidator class and store the result in the $validationResult variable
                    $filBackValidate = FormValidator::validate( $backUrl );

                    # If there are errors in the validation result, we return a JSON response with the errors and a 400 status code
                    if ( $filBackValidate['success'] === false ) {
                        Response::response(['success' => false, 'message' => $filBackValidate['message']], 400);
                        return;
                    }
                    # We execute the login logic if the validation is successful
                    $inputs = $filBackValidate['inputs'] ?? [];

                    # We retrieve the inputs configuration for the login form from the $inputsConfig attribute, which was initialized in the constructor using the FormLoginConfig class
                    $inputsConfig = $this->inputsConfig;
                    # We validate the fields using the FormValidator class and store the result in the $filBackFieldValidate variable
                    $filBackFieldValidate = FormValidator::fieldValidate( $inputsConfig, $inputs, $backUrl );
                    if ( $filBackFieldValidate['success'] === false ) {
                        Response::response(['success' => false, 'message' => $filBackFieldValidate['message']], 400);
                        return;
                    }

                    /* METIER LOGIC */
                    $userManager = new UserManager();
                    $user = $userManager->findByReferer($inputs['identifiant'] ?? '');
                    # If the user is not found, we return a JSON response with an error message and a 400 status code
                    if (!$user) {
                        Response::response(['success' => false, 'message' => MessageConfig::getMessage('login_error_identifier')], 400);
                        return;
                    }

                    # We verify the password using the password_verify() function and the userPassword property of the UserEntity class
                    if (!password_verify($inputs['password'] ?? '', $user->getUserPassword() ?? '')) {
                        Response::response(['success' => false, 'message' => MessageConfig::getMessage('login_error_password')], 400);
                        return;
                    }
                    # If the password is correct, we set the user data in the session using the SessionManager class and regenerate the session ID for better security
                    $this->sessionManager->regenerateSession();
                    # We set the user data in the session using the setSession() method of the SessionManager class, we store the user ID, name, first name, email and level in the session for later use in the application
                    $this->sessionManager->setSession('user', ['idUser' => $user->getIdUserAccount(), 'name' => $user->getUsername(), 'first' => $user->getUserFirstName(), 'email' => $user->getUserEmail(), 'level' => $user->getUserLevel()]);

                    # If the validation is successful, we return a JSON response with a success message and a 200 status code
                    Response::response(['success' => true, 'message' => MessageConfig::getMessage('login_success'), 'redirectUrl'=> 'home'], 200);

                }

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

?>
