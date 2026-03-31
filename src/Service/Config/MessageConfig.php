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
        namespace App\src\Service\Config;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class MessageConfig{

            /* ▂ ▅ Constants ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

                 /* ▂ ▅  getMessage() ▅ ▂ */
                 /** @param string $key : the key of the message to get
                  * @param array $arguments : the arguments to replace in the message
                  *  @return string : the message corresponding to the key */
                public static function getMessage( string $key, ?array $arguments = null  ) : string {
                    $redirectUrl = $arguments['redirect_url'] ?? '';
                    $field = $arguments['field'] ?? '';
                    $messages = [
                        #ERRORS
                        'csrf_token_error' => "Le Jeton CSRF est invalide ou a expiré. Merci de rafraîchir la page et de réessayer. <a class='ms-2' href='{$redirectUrl}'>Rafraîchir</a>",
                        'antibot_error' => "Détection d'une activité suspecte. Si vous n'êtes pas un robot, merci de rafraîchir la page et de réessayer. <a class='ms-2' href='{$redirectUrl}'>Rafraîchir</a>",
                        'method_error' => "Détection d'une requête malveillante. Méthode HTTP non autorisée. Merci de rafraîchir la page et de réessayer. <a class='ms-2' href='{$redirectUrl}'>Rafraîchir</a>",
                        # PROCESS SUCCESSES
                        'login_success' => "Connexion réussie. Redirection en cours...",
                        'logout_success' => "Déconnexion réussie. Redirection en cours...",
                        # PROCESSES ERRORS
                        'login_error_identifier' => "Utilisateur non trouvé. Veuillez vérifier votre identifiant et réessayer.",
                        'login_error_password' => "Mot de passe incorrect. Veuillez vérifier votre mot de passe et réessayer.",
                        # FORM ERRORS
                        'field_required_error' => "Le champ {$field} est requis.",
                        'field_min_length_error' => "Le champ {$field} doit contenir au moins {min} caractères.",
                        'field_max_length_error' => "Le champ {$field} doit contenir au maximum {max} caractères.",
                        'field_pattern_error' => "Le champ {$field} ne respecte pas le format requis.",
                   
                        ];
                    return $messages[$key] ?? '';
                }






            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
    
?>
