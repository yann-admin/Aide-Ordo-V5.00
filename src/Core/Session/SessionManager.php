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
        namespace App\src\Core\Session;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class SessionManager{
            /* ▂ ▅ Constants ▅ ▂ */
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅ startSession() ▅ ▂ */
                /** @return void */
                public function startSession() : void {
                    /* MEMO session_start() doit être appelé avant tout envoi de données au client (avant tout echo, print, var_dump, etc.) sinon cela génère une erreur "Headers already sent". Assurez-vous que ce code est exécuté avant tout autre code qui pourrait envoyer des données au client. */
                        # Reco via https://www.php.net/manual/en/session.security.ini.php:
                        /** @param name */
                        # Il est recommandé de changer le nom $_SESSION['PHPSESSID'] pour une application réelle

                        /** @param lifetime */
                        # 0 possède une signification particulière. Il informe les navigateurs de ne pas stocker le cookie en stockage permanent. Par conséquent, lorsque le navigateur est terminé, le cookie d’ID de session est immédiatement supprimé. Si les développeurs définissent cela autrement que 0, cela peut permettre à d’autres utilisateurs d’utiliser l’ID de session. La plupart des applications devraient utiliser « » pour cela. 0 est approprié pour les applications très sensibles à la sécurité.

                        /** @param use_cookies */
                        # Session.use_cookies précise si le Le module utilisera des cookies pour stocker l’identifiant de session sur le client Side. Par défaut à 1 (activé)

                        /** @param only_cookies */
                        # Session.use_only_cookies précise si Le module n’utilisera que Des cookies pour stocker l’identifiant de session côté client. Activer ce paramètre empêche les attaques impliquant de passer une session Les identifiants dans les URL. Par défaut à 1 (activé).

                        /** @param strict_mode */
                        # Session.use_strict_mode précise si le Le module utilisera un mode d’identification de session strict. Si ce mode est activé, le module n’accepte pas d’identifiants de session non initialisés. Si un non initialisé l’identifiant de session est envoyé depuis le navigateur, un nouvel identifiant de session est envoyé au navigateur. Les applications sont protégées contre la fixation de session via l’adoption de session avec un mode strict. Par défaut à 0 (désactivé).

                        /** @param httponly */
                        # Marque le cookie pour qu'il ne soit accessible que via le protocole HTTP. Cela signifie que le cookie ne sera pas accessible par les langage de script, comme Javascript. Cette configuration permet de limiter les attaques comme les attaques XSS (bien qu'elle n'est pas supporté par tous les navigateurs).

                        /** @param secure */
                        # Session.cookie_secure précise si Les cookies ne doivent être envoyés que via des connexions sécurisées. Avec cet ensemble d’options pour les sessions ne fonctionnent qu’avec des connexions HTTPS. Si c’est désactivé, alors les sessions fonctionnent à la fois avec HTTP et Connexions HTTPS. Par défaut, c’est désactivé. Voir aussi session_get_cookie_params() et session_set_cookie_params().

                        /** @param samesite */
                        # Permet aux serveurs d’affirmer qu’un cookie ne doit pas être envoyé avec Demandes inter-sites. Cette affirmation permet aux agents utilisateurs d’atténuer le risque de fuite d’informations à origine croisée, et offre une certaine protection contre Attaques de falsification par demande inter-site. Notez que cela n’est pas pris en charge par tous navigateurs. Une valeur vide signifie qu’aucun attribut de cookie SameSite ne sera défini. Laxiste et Strict signifient que le cookie ne sera pas envoyé en cross-domaine pour les requêtes POST ; Lax enverra le cookie pour les requêtes GET inter-domaine, tandis que Strict ne le fera pas.

                        /** @param domain */
                        # Session.cookie_domain spécifie le domaine pour lequel le cookie de session est disponible. Par défaut, c’est la valeur de $_SERVER['HTTP_HOST']. Voir aussi session_get_cookie_params() et session_set_cookie_params().

                        /** @param path */
                        # Session.cookie_path spécifie chemin vers ensemble dans le cookie de session. Par défaut /. Voir aussi session_get_cookie_params() et session_set_cookie_params().
                    /*_________________________________________________*/

                    if (session_status() === PHP_SESSION_NONE) {

                        session_name('AideHordo'); # Change the default session name from PHPSESSID to something custom for better security and to avoid conflicts with other applications on the same server

                        ini_set('session.use_strict_mode', 1); # Empêche les attaques de fixation de session en rejetant les ID de session non initialisés
                        ini_set('session.use_only_cookies', 1); # Empêche les attaques impliquant de passer des ID de session dans les URL
                        ini_set('session.use_cookies', 1); # Active l'utilisation des cookies pour stocker l'ID de session côté client

                        # Depuis PHP 7.3+, il est préférable d'utiliser:
                        session_set_cookie_params([
                            'lifetime' => 0, # Le cookie de session expire lorsque le navigateur est fermé
                            'path' => '/', # Le cookie est disponible pour tout le domaine
                            //'domain' => $_SERVER['HTTP_HOST'] ?? '', # Le cookie est disponible pour le domaine actuel Attention à ne pas utiliser $_SERVER['HTTP_HOST'] sans validation, car il peut être manipulé par l'utilisateur. Il est recommandé de définir explicitement le domaine ou de le laisser vide pour utiliser le domaine actuel de manière sécurisée.
                            'secure' => isset($_SERVER['HTTPS']), # Le cookie n'est envoyé que via des connexions sécurisées (HTTPS)
                            'httponly' => true, # Le cookie n'est accessible que via le protocole HTTP, ce qui limite les attaques XSS, JS ne peut pas lire le cookie
                            'samesite' => 'Strict' # Le cookie n'est envoyé que pour les requêtes du même site
                        ]);

                        session_start();
                    }

                }


                /* ▂ ▅ isExistSession() ▅ ▂ */
                /** @param string $key */
                /** @return bool */
                public function isExistSession(string $key) : bool {
                    if (session_status() === PHP_SESSION_ACTIVE) {
                        return isset($_SESSION[$key]);
                    }
                    return false;
                }

                /* ▂ ▅ setSession() ▅ ▂ */
                /** @return void */
                public function setSession(string $key, mixed $value) : void {
                    $_SESSION[$key] = $value;
                }

                /* ▂ ▅ getSession() ▅ ▂ */
                /** @return mixed */
                public function getSession(string $key) {
                    return $_SESSION[$key] ?? null;
                }
                
                /* ▂ ▅ isSessionExpired() ▅ ▂ */
                /** @return bool */
                public function isSessionExpired() : bool {
                    if (session_status() === PHP_SESSION_ACTIVE) {
                        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $_ENV['SESSION_TIMEOUT'])) {
                            return true;
                        }
                        $_SESSION['LAST_ACTIVITY'] = time();
                    }
                    return false;
                }

                /* ▂ ▅ needsSessionRegeneration() ▅ ▂ */
                /** @return bool */
                public function needsSessionRegeneration() : bool {
                    if (session_status() === PHP_SESSION_ACTIVE) {
                        if (!isset($_SESSION['CREATED'])) {
                            $_SESSION['CREATED'] = time();
                        } elseif (time() - $_SESSION['CREATED'] > $_ENV['SESSION_REGENERATE_INTERVAL']) {
                            return true;
                        }
                    }
                    return false;
                }

                /* ▂ ▅ regenerateSession() ▅ ▂ */
                /** @return void */
                public function regenerateSession() : void {
                    if (session_status() === PHP_SESSION_ACTIVE) {
                        session_regenerate_id(true);
                    }
                }

                /* ▂ ▅ destroySession() ▅ ▂ */
                /** @return void */
                public function destroySession() : void {
                    if (session_status() === PHP_SESSION_ACTIVE) {
                        session_unset();
                        session_destroy();
                    }
                }

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>
