<?php
    declare(strict_types=1);
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        namespace App\src\Service\Security;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */
        # We include the Road class to get the list of roads and their paths, which is a class that has properties corresponding to the columns of the road table in the database and a constructor to initialize them
        use App\config\Road;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class Redirect{

             /* ▂ ▅ Constants ▅ ▂ */

            /* ▂ ▅ Constants ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅  verifyBackUrl() ▅ ▂ */
                /** Redirects the user to the previous page or a default URL if no previous page is available */
                /** @param string $default The default URL to redirect to if no previous page is available */
                /** @return void */
                public static function verifyBackUrl( ?string $url = null ): bool {
                    # We check if the URL is empty, if it is we return false
                    if ( empty($url) ) {return false; }
                        
                    
                    # We remove the query parameters from the URL to get the root path
                    $root = explode('/', $url) ;
                    $url = '/' . end($root);
                    # We get the list of roads from the Road class, which is a class that has a static method that returns an array of routes with their corresponding HTTP methods, paths, and controller actions
                    $roads = Road::getRoad();
                    # We check if the URL is a valid URL
                    foreach ($roads as $road) {
                        if ($road['path'] === $url) {
                            return true;
                        }
                    }

                    return false;
                }

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
    
?>
