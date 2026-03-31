<?php
    # We charge a configuration file that contains the database connection parameters and other settings.
    $config = require dirname(__DIR__) . '/boot/app.php';

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

        # Class Autoloader
        use App\Autoloader;

        # Class Router
        use App\src\Core\Router\Router;

        # Class SessionManager
        use App\src\Core\Session\SessionManager;

        include '../Autoloader.php';
    error_reporting(E_ALL);
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    Autoloader::register();

    # We initialize the session manager and start the session
        $sessionManager = new SessionManager();

    # We initialize the session and set the session cookie parameters for better security
        $sessionManager -> startSession();

    # We check if the session has expired and if it needs to be regenerated for better security $_ENV['SESSION_TIMEOUT']
        if ($sessionManager -> isSessionExpired()) {
            $sessionManager -> destroySession();
            $sessionManager -> regenerateSession();
        }

    # We check if the session needs to be regenerated for better security $_ENV['SESSION_REGENERATE_INTERVAL']
        if ($sessionManager -> needsSessionRegeneration()) {
            $sessionManager -> regenerateSession();
        }

    # We initialize the router and the session manager
        Router::setRoads();

    # On lance l'application :
        Router::dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

?>

                        
