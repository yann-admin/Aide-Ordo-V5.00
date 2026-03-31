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
        namespace App\src\Service\Security;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class Field{

            /* ▂ ▅ Constants ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅ cleanData ▅ ▂ */
                /** @param string $data : the data to clean
                 *  @return string : the cleaned data */
                public static function cleanData( string $data ) : string {
                    # We loop through the data and apply the encodeXssTrim() method to each value
                    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
                }

                /* ▂ ▅ isRequired ▅ ▂ */
                /** @param string $value : the data to validate
                 *  @return bool : whether the data is required */
                public static function isRequired( string $value ) : bool {
                    if ( empty($value) ) {
                        return false;
                    }
                    return true;
                }

                /* ▂ ▅ isMinLength ▅ ▂ */
                /** @param string $value : the data to validate
                 *  @param int $min : the minimum length
                 *  @return bool : the cleaned data */
                public static function isMinLength( string $value, int $min ) : bool {
                    if ( strlen($value) < $min ) {
                        return false;
                    }
                    return true;
                }

                /* ▂ ▅ isMaxLength ▅ ▂ */
                /** @param string $value : the data to validate
                 * @param int $max : the maximum length
                 *  @return bool : the cleaned data */
                public static function isMaxLength( string $value, int $max ) : bool {
                    if ( strlen($value) > $max ) {
                        return false;
                    }
                    return true;
                }

                /* ▂ ▅ validateRegex ▅ ▂ */
                /** @param string $value : the data to validate
                 *  @param string $regex : the regex pattern to validate against
                 *  @return bool : the cleaned data */
                public static function validateRegex( string $regex, string $value ) : bool {
                    $regex = '/' . $regex . '/'; // We add start and end delimiters to the regex pattern
                    if ( !preg_match($regex, $value) ) {
                        return false;
                    }
                    return true;
                }


            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
    
?>
