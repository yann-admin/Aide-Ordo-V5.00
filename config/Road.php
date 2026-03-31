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
        namespace App\config;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class Road{

            /* ▂ ▅ Constants ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */
            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅  getRoad() ▅ ▂ */
                /** @return array : the road array */
                public static function getRoad(): array {
                    $road = [];
                    # We define the road array, which contains the paths for the different pages of the application, and we return it as an associative array where the keys are the page names and the values are the corresponding paths
                    # We define the road for the error page, which will be used to display error messages to the user when an error occurs, and we specify the controller and method that will handle the request for this page
                    $road[] = ['method' => 'GET', 'path' => '/error', 'action' => 'HomeController@error'];

                    # We define the road for the home page, which will be the main page of the application, and we specify the controller and method that will handle the request for this page
                    $road[] = ['method' => 'GET', 'path' => '/home', 'action' => 'HomeController@index'];

                    # We define the roads for the user login and logout pages, which will be used to authenticate users and manage their sessions, and we specify the controllers and methods that will handle the requests for these pages
                    $road[] = ['method' => 'GET', 'path' => '/login', 'action' => 'UserController@index'];
                    $road[] = ['method' => 'GET', 'path' => '/logout', 'action' => 'UserController@logout'];
                    $road[] = ['method' => 'POST', 'path' => '/login/login', 'action' => 'UserController@login'];

                    # We define the roads for the factory management pages, which will be used to display the list of factories, create new factories, update existing factories, and delete factories, and we specify the controllers and methods that will handle the requests for these pages
                    $road[] = ['method' => 'GET', 'path' => '/factory', 'action' => 'FactoryController@index'];
                    $road[] = ['method' => 'GET', 'path' => '/factory-create', 'action' => 'FactoryController@form'];
                    $road[] = ['method' => 'GET', 'path' => '/factory-update-{id}', 'action' => 'FactoryController@form'];
                    $road[] = ['method' => 'GET', 'path' => '/factory-subtract-{id}', 'action' => 'FactoryController@subtract'];
                    # We use the same route for both create and update, the controller will handle the logic to differentiate between the two actions based on the presence of the id parameter
                    $road[] = ['method' => 'POST', 'path' => '/factory-save-{id}', 'action' => 'FactoryController@save'];
                    $road[] = ['method' => 'POST', 'path' => '/factory-delete-{id}', 'action' => 'FactoryController@delete'];

                    # We define the roads for the line management pages, which will be used to display the list of lines, create new lines, update existing lines, and delete lines, and we specify the controllers and methods that will handle the requests for these pages
                    $road[] = ['method' => 'GET', 'path' => '/line', 'action' => 'LineController@index'];
                    $road[] = ['method' => 'GET', 'path' => '/line-create', 'action' => 'LineController@form'];
                    $road[] = ['method' => 'GET', 'path' => '/line-update-{id}', 'action' => 'LineController@form'];
                    $road[] = ['method' => 'GET', 'path' => '/line-subtract-{id}', 'action' => 'LineController@subtract'];
                    # We use the same route for both create and update, the controller will handle the logic to differentiate between the two actions based on the presence of the id parameter
                    $road[] = ['method' => 'POST', 'path' => '/line-save-{id}', 'action' => 'LineController@save'];
                    $road[] = ['method' => 'POST', 'path' => '/line-delete-{id}', 'action' => 'LineController@delete'];

                    # We define the roads for the topology management pages, which will be used to display the list of topologies, create new topologies, update existing topologies, and delete topologies, and we specify the controllers and methods that will handle the requests for these pages
                    $road[] = ['method' => 'GET', 'path' => '/topologie', 'action' => 'TopologieController@index'];
                    $road[] = ['method' => 'GET', 'path' => '/topologie-create', 'action' => 'TopologieController@form'];
                    $road[] = ['method' => 'GET', 'path' => '/topologie-update-{id}', 'action' => 'TopologieController@form'];
                    $road[] = ['method' => 'GET', 'path' => '/topologie-subtract-{id}', 'action' => 'TopologieController@subtract'];
                    # We use the same route for both create and update, the controller will handle the logic to differentiate between the two actions based on the presence of the id parameter
                    $road[] = ['method' => 'POST', 'path' => '/topologie-save-{id}', 'action' => 'TopologieController@save'];
                    $road[] = ['method' => 'POST', 'path' => '/topologie-delete-{id}', 'action' => 'TopologieController@delete'];

                    # We define the roads for the piece format management pages, which will be used to display the list of piece formats, create new piece formats, update existing piece formats, and delete piece formats, and we specify the controllers and methods that will handle the requests for these pages
                    $road[] = ['method' => 'GET', 'path' => '/piece-format', 'action' => 'PieceFormatController@index'];
                    $road[] = ['method' => 'GET', 'path' => '/piece-format-create', 'action' => 'PieceFormatController@form'];
                    $road[] = ['method' => 'GET', 'path' => '/piece-format-update-{id}', 'action' => 'PieceFormatController@form'];
                    $road[] = ['method' => 'GET', 'path' => '/piece-format-subtract-{id}', 'action' => 'PieceFormatController@subtract'];
                    # We use the same route for both create and update, the controller will handle the logic to differentiate between the two actions based on the presence of the id parameter
                    $road[] = ['method' => 'POST', 'path' => '/piece-format-save-{id}', 'action' => 'PieceFormatController@save'];
                    $road[] = ['method' => 'POST', 'path' => '/piece-format-delete-{id}', 'action' => 'PieceFormatController@delete'];

                    # We define the roads for the production management pages, which will be used to display the list of productions, create new productions, update existing productions, and delete productions, and we specify the controllers and methods that will handle the requests for these pages
                    $road[] = ['method' => 'GET', 'path' => '/production', 'action' => 'ProductionController@index'];
                    $road[] = ['method' => 'GET', 'path' => '/production-create', 'action' => 'ProductionController@form'];
                    $road[] = ['method' => 'GET', 'path' => '/production-update-{id}', 'action' => 'ProductionController@form'];
                    $road[] = ['method' => 'GET', 'path' => '/production-subtract-{id}', 'action' => 'ProductionController@subtract'];
                    # We use the same route for both create and update, the controller will handle the logic to differentiate between the two actions based on the presence of the id parameter
                    $road[] = ['method' => 'POST', 'path' => '/production-save-{id}', 'action' => 'ProductionController@save'];
                    $road[] = ['method' => 'POST', 'path' => '/production-delete-{id}', 'action' => 'ProductionController@delete'];


                    # We define the roads for the API endpoints, which will be used to handle AJAX requests from the frontend, and we specify the controllers and methods that will handle the requests for these endpoints
                    $road[] = ['method' => 'POST', 'path' => '/fetch-topologies-by-line', 'action' => 'ApiController@fetchTopologiesByLine'];
                    $road[] = ['method' => 'POST', 'path' => '/fetch-topologies-create', 'action' => 'ApiController@fetchTopologiesCreate'];


                    # We return the road array, which will be used by the router to match incoming requests to the appropriate controllers and methods based on the request method and path
                    return $road;

                }

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
    
?>
