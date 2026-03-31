<?php

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */
        use Dotenv\Dotenv;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

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

    /* Charger les configs */
    $config = [
        'app' => require $rootDir . '/config/app.php',
        'databaseSQL' => require $rootDir . '/config/databaseSQL.php',
        'databaseNoSQL' => require $rootDir . '/config/databaseNoSQL.php'
    ];

    return $config;

?>
