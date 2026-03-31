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
        namespace App\src\Core;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

        # Class SessionManager
        use App\src\Core\Session\SessionManager;

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class AuthenticationRedirect {
            /* ▂ ▅ Constants ▅ ▂ */
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */
                private SessionManager $sessionManager;
                private const REDIRECT_HOME = 'home';
                private const REDIRECT_LOGIN = 'login';
            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅ Constructor ▅ ▂ */
                public function __construct(SessionManager $sessionManager) {
                    # We initialize the SessionManager to manage user sessions and authentication
                    $this->sessionManager = $sessionManager;

                }

                /* ▂ ▅ requireAuthentication() ▅ ▂ */
                /** @return bool : true if the user is authenticated, false otherwise */
                public function requireAuthentication(): void {
                    if (!$this->isAuthenticated()) {
                        $this -> redirect(self::REDIRECT_LOGIN);
                    }
                }

                /* ▂ ▅ isAuthenticated() ▅ ▂ */
                /** @return bool : true if the user is authenticated, false otherwise */
                public function isAuthenticated(): bool {
                    return $this->sessionManager->isExistSession('user');
                }

                /* ▂ ▅ ifAuthenticated() ▅ ▂ */
                public function ifAuthenticated(): void {
                    if ($this->isAuthenticated()) {
                        $this->redirect(self::REDIRECT_HOME);
                    }
                }

                /* ▂ ▅ getUserLevel() ▅ ▂ */
                /** @return int : the user level if the user is authenticated, 0 otherwise */
                public function getUserLevel(): int {
                    if ($this->isAuthenticated()) {
                        return $this->sessionManager->getSession('user')['level'];
                    }
                    return 0;
                }


                /* ▂ ▅ redirect() ▅ ▂ */
                /** @param void  */
                private function redirect(string $route): void {
                    header("Location: $route");
                    exit;
                }

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>
