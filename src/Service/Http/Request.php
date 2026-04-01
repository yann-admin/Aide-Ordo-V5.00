<?php
    declare(strict_types=1);
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
        namespace App\src\Service\Http;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class Request {

            /* ▂ ▅ Constants ▅ ▂ */
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */
            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅  isPost() ▅ ▂ */
                public static function isPost() : bool {
                    if($_SERVER['REQUEST_METHOD'] === 'POST'){
                        return true;
                    }
                    return false;
                }

                /* ▂ ▅  isGet() ▅ ▂ */
                public static function isGet() : bool {
                    if($_SERVER['REQUEST_METHOD'] === 'GET'){
                        return true;
                    }
                    return false;
                }

                public static function inputDecode() : array {
                    $data=[];
                    # We get the raw input data from the request body
                    $input = file_get_contents('php://input');
                    # We decode the JSON data into an associative array
                    $data = json_decode($input, true);
                    # We return the decoded data
                    return $data;
                }

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>
