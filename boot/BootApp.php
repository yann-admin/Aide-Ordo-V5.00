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
        namespace App\boot;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */
        use Dotenv\Dotenv;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class BootApp{

            /* ▂ ▅ Constants ▅ ▂ */
                
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */
            // private array $bootConfig = [];
            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Constructor ▅ ▂ */
            public function __construct() {
                $rootDir = dirname(__DIR__);

                /* Charger .env */
                require $rootDir . '/vendor/autoload.php';
                $dotenv = Dotenv::createImmutable($rootDir);
                $dotenv->load();

                $env = $_ENV['APP_ENV'] ?? 'production';
                $envFile = $rootDir . '/.env.' . $env;
                if (file_exists($envFile)) {
                    $dotenvEnv = Dotenv::createImmutable($rootDir, '.env.' . $env);
                    $dotenvEnv->load();
                }

                // /* Charger les configs */
                // $config = [
                //     'app' => require $rootDir . '/config/app.php',
                //     'databaseSQL' => require $rootDir . '/config/databaseSQL.php',
                //     'databaseNoSQL' => require $rootDir . '/config/databaseNoSQL.php'
                // ];

                // $this->bootConfig = $config;
            }



            // public function getBootConfig(): array {
            //     return $this->bootConfig;
            // }
        }






?>
