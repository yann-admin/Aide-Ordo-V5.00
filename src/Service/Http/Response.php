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
        class Response {

            /* ▂ ▅ Constants ▅ ▂ */
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */
            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

            public static function response(array $data, int $statusCode = 200) : void {
                # We set the HTTP response code
                # https://www.php.net/manual/fr/function.http-response-code.php
                http_response_code($statusCode);
                # We set the Content-Type header to application/json
                header('Content-Type: application/json');
                # We encode the data array into a JSON string and output it
                # https://www.php.net/manual/fr/function.json-encode.php
                # https://www.php.net/manual/en/json.constants.php
                    # JSON_UNESCAPED_UNICODE -> Encoder littéralement les caractères Unicode multioctets (par défaut échapper comme \uXXXX).
                    # JSON_UNESCAPED_SLASHES -> Ne pas échapper les caractères / (par défaut échapper comme \/).
                    # JSON_PRETTY_PRINT -> Utiliser un format de sortie JSON lisible par l'homme (ajoute des espaces et des sauts de ligne).
                echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
                exit;
            }

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>
