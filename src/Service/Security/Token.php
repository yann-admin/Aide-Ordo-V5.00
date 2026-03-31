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

    /* ▂ ▅ ▆ █  MEMO  █ ▆ ▅ ▂ */
        # CSRF (Cross-Site Request Forgery) ( XSS ): attaque qui consiste à faire exécuter une action à un utilisateur authentifié sur un site web à son insu. Soit en remplaçant les caractères formant des balises HTML par leur propre code avec la fonction htmlspecialchars(), soit en utilisant des tokens CSRF pour protéger les formulaires contre les attaques CSRF. Un token CSRF est une chaîne de caractères aléatoire qui est générée par le serveur et qui est associée à la session de l'utilisateur. Ce token est ensuite inclus dans les formulaires HTML et vérifié par le serveur lors de la soumission du formulaire. Si le token n'est pas valide ou a expiré, la requête est rejetée.
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class Token{

            /* ▂ ▅ Constants ▅ ▂ */
            /* ▂▂▂▂▂▂▂▂▂▂▂ */
            
            /* ▂ ▅ Attributs ▅ ▂ */
                private static string $token;
                private static int $tokenTime;
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅  generateToken() ▅ ▂ */
                /** @return array */
                public static function generateToken() : array {
                    # Checks if $_SESSION['csrf_token'] exists and if not = NULL
                    if(isset($_SESSION['csrf_token'])){
                        # destroy session token
                        self::destroyToken();
                    }
                    # A new token is instantiated
                    self::$token = (bin2hex(random_bytes(32)));
                    # We set the token time to the current time
                    self::$tokenTime = time();
                    # We set the token in the session
                    self::setSessionToken();
                    # We return the token value
                    return ['csrf_token' => self::$token, 'csrf_token_time' => self::$tokenTime];
                }

                /* ▂ ▅  setSessionToken() ▅ ▂ */
                /** @return void */
                public static function setSessionToken() : void {
                    $_SESSION['csrf_token'] = self::$token;
                    $_SESSION['csrf_token_time'] = self::$tokenTime;
                }

                /* ▂ ▅  destroyToken() ▅ ▂ */
                /** @return void */
                public static function destroyToken() : void {
                    unset($_SESSION['csrf_token']);
                    unset($_SESSION['csrf_token_time']);
                }

                /* ▂ ▅  verifyToken() ▅ ▂ */
                /** @param string $token : the token to verify
                 *  @return bool : true if the token is valid, false otherwise */
                public static function verifyToken(string $token) : bool {
                    # We check if the token exists in the session and if it is not expired
                    if (isset($_SESSION['csrf_token']) && isset($_SESSION['csrf_token_time'])) {
                        $sessionToken = $_SESSION['csrf_token'];
                        $sessionTokenTime = $_SESSION['csrf_token_time'];
                        # We check if the token is valid and if it is not expired
                        # hash_equals — Comparaison de chaînes résistante aux attaques temporelles https://www.php.net/manual/fr/function.hash-equals.php
                            # hash_equals() compare deux chaînes de manière sécurisée pour éviter les attaques de timing. Elle retourne true si les chaînes sont égales, false sinon.
                            # Il est important de passer la chaîne fournie par l'utilisateur en tant que second paramètre plutôt qu'en premier.
                        if (hash_equals($sessionToken, $token) && (time() - $sessionTokenTime) < $_ENV['CSRF_TOKEN_EXPIRATION_TIME']) {
                            return true;
                        }
                    }
                    return false;
                }

                /* ▂ ▅  createTokenInput() ▅ ▂ */
                /** @return string : HTML input element with the CSRF token */
                public static function createTokenInput() : string {
                    self::destroyToken();
                    $tokenCreate = self::generateToken();
                    return htmlspecialchars($tokenCreate['csrf_token'], ENT_QUOTES, 'UTF-8');
                }

                /* ▂ ▅  verifyAntibot() ▅ ▂ */
                /** @param string $value : the data to check
                 *  @return bool : true if the data is valid, false otherwise */
                public static function verifyAntibot(string $value) : bool {
                    # We check if the value is empty, if it is not empty, it means that the bot has filled the field and we return false, otherwise we return true
                    if(empty($value)){
                        return true;
                    }
                    return false;
                }

            /* ▂▂▂▂▂▂▂▂▂▂▂ */
        }
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>
