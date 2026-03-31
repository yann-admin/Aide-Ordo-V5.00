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
        namespace App\Config;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
    class RegexConfig {
        /* ▂ ▅ ▆ █ Constants █ ▆ ▅ ▂ */
            private const REGEX_ID = "/^\d+$/"; // Permet de valider les identifiants numériques (chiffres uniquement)
            private const REGEX_IDENTIFIANT = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-zÀ-ÖØ-öø-ÿ\d_\-]{8,}$/"; // Permet de valider les identifiants avec au moins 8 caractères, incluant au moins une lettre majuscule, une lettre minuscule et un chiffre, et autorisant les lettres, les chiffres, les tirets bas (_) et les tirets (-)    
            private const REGEX_PASSWORD = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\/@$!%*?&#])[A-Za-zÀ-ÖØ-öø-ÿ\d\/@$!%*?&#]{8,}$/"; // Permet de valider les mots de passe avec au moins 8 caractères, incluant au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial parmi /@$!%*?&#, et autorisant les lettres, les chiffres, les tirets bas (_) et les tirets (-)
            private const REGEX_EMAIL = "/^^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/"; // Permet de valider les adresses e-mail avec des caractères alphanumériques, des points, des tirets et des signes plus dans la partie locale, et un domaine valide avec une extension d'au moins 2 caractères
            private const REGEX_PHONE = "/^\+?[0-9\s_.\-]{10,15}$/"; // Permet de valider les numéros de téléphone avec ou sans le signe +, et entre 10 et 15 chiffres
            private const REGEX_ADDRESS = "/^[0-9A-Za-zÀ-ÖØ-öø-ÿ'\s\-]+$/"; // Permet les lettres, les chiffres, les espaces, les virgules, les apostrophes et les tirets dans les adresses
            private const REGEX_POSTAL_CODE = "/^\d{5}$/"; // Permet de valider les codes postaux français (5 chiffres)
            private const REGEX_CITY = "/^[A-Za-zÀ-ÖØ-öø-ÿ'\s\-]+$/"; // Permet les lettres, les espaces, les tirets et les apostrophes dans les noms de villes
            private const REGEX_TEXT = "/^[A-Za-zÀ-ÖØ-öø-ÿ'\s\-\/@$!%*?&#]+$/"; // Permet les lettres, les espaces, les tirets et les apostrophes dans les champs de texte
            private const REGEX_NUMBER = "/^\d+$/"; // Permet de valider les nombres entiers (positifs)
            private const REGEX_DATE = "/^\d{4}-\d{2}-\d{2}$/"; // Format ISO 8601 pour les dates
            private const REGEX_DATETIME = "/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/"; // Format ISO 8601 sans les secondes
            private const REGEX_URL = "/^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-._~:/?#[\]@!$&'()*+,;=]*)?$/"; // Permet de valider les URL avec ou sans le protocole (http, https) et avec des chemins d'accès optionnels
            private const REGEX_TEXTAREA = "/^[A-Za-zÀ-ÖØ-öø-ÿ\s'\-\d\/@$!%*?&#]+$/"; // Permet les lettres, les chiffres, les espaces et les tirets dans les textarea
            private const REGEX_CUSTOM = "/.*/"; // Exemple de regex personnalisée qui accepte tout
            private const REGEX_CUSTOM_STRICT = "/^[A-Za-z0-9]+$/"; // Exemple de regex personnalisée stricte qui n'accepte que les lettres et les chiffres
            private const REGEX_CUSTOM_LOOSE = "/^[A-Za-z0-9\-\s']+$/"; // Exemple de regex personnalisée plus souple qui accepte les lettres, les chiffres, les tirets, les espaces et les apostrophes
            private const REGEX_SIRET = "/^\d{14}$/"; // Exemple de regex pour un numéro SIRET français (14 chiffres)
            private const REGEX_SIREN = "/^\d{9}$/"; // Exemple de regex pour un numéro SIREN français (9 chiffres)
            private const REGEX_IBAN = "/^[A-Z]{2}\d{2}[A-Z0-9]{1,30}$/"; // Exemple de regex pour un numéro IBAN international
            private const REGEX_BIC = "/^[A-Z]{4}[A-Z]{2}[A-Z0-9]{2}([A-Z0-9]{3})?$/"; // Exemple de regex pour un code BIC international
            private const REGEX_APE = "/^\d{4}[A-Z]$/"; // Exemple de regex pour un code APE français (4 chiffres suivis d'une lettre)
            private const REGEX_SELECT_NUM = "/^\d+$/"; // Exemple de regex pour un identifiant numérique (chiffres uniquement)
            private const REGEX_SELECT_STR = "/^[A-Za-zÀ-ÖØ-öø-ÿ\s'\-\d\/@$!%*?&#]+$/"; // Exemple de regex pour une valeur de select qui peut être un texte avec des lettres, des chiffres, des espaces et des caractères spéciaux

            private const TITLE_ID = "Veuillez entrer un identifiant numérique valide (chiffres uniquement).";
            private const TITLE_IDENTIFIANT = "Votre identifiant doit comporter au moins 8 caractères, inclure au moins une lettre majuscule, une lettre minuscule. Il peut inclure des lettres, des chiffres, des tirets bas (_) et des tirets (-).";
            private const TITLE_PASSWORD = "Votre mot de passe doit comporter au moins 8 caractères, inclure au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial (/@$!%*?&#). Il peut inclure des lettres, des chiffres, des tirets bas (_) et des tirets (-).";
            private const TITLE_EMAIL = "Veuillez entrer une adresse e-mail valide.";
            private const TITLE_PHONE = "Veuillez entrer un numéro de téléphone valide (10 à 15 chiffres, peut commencer par +).";
            private const TITLE_POSTAL_CODE = "Veuillez entrer un code postal valide (5 chiffres).";
            private const TITLE_ADDRESS = "Veuillez entrer une adresse valide (lettres, chiffres, espaces, virgules, apostrophes et tirets uniquement).";
            private const TITLE_CITY = "Veuillez entrer un nom de ville valide (lettres, espaces, tirets et apostrophes uniquement).";
            private const TITLE_TEXT = "Veuillez entrer un texte valide (lettres, espaces, tirets et apostrophes uniquement).";
            private const TITLE_NUMBER = "Veuillez entrer un nombre valide (chiffres uniquement).";
            private const TITLE_DATE = "Veuillez entrer une date valide (format YYYY-MM-DD).";
            private const TITLE_DATETIME = "Veuillez entrer une date et heure valide (format YYYY-MM-DDTHH:MM).";
            private const TITLE_URL = "Veuillez entrer une URL valide.";
            private const TITLE_TEXTAREA = "Veuillez entrer un texte valide (lettres, espaces, tirets et chiffres uniquement).";
            private const TITLE_CUSTOM = "Veuillez entrer une valeur valide.";
            private const TITLE_CUSTOM_STRICT = "Veuillez entrer une valeur valide (lettres et chiffres uniquement).";
            private const TITLE_CUSTOM_LOOSE = "Veuillez entrer une valeur valide (lettres, chiffres et espaces uniquement).";
            private const TITLE_SIRET = "Veuillez entrer un numéro SIRET valide (14 chiffres).";
            private const TITLE_SIREN = "Veuillez entrer un numéro SIREN valide (9 chiffres).";
            private const TITLE_IBAN = "Veuillez entrer un numéro IBAN valide (2 lettres suivies de 2 chiffres et jusqu'à 30 caractères alphanumériques).";
            private const TITLE_BIC = "Veuillez entrer un code BIC valide (4 lettres, suivies de 2 lettres et 2 caractères alphanumériques, avec une option de 3 caractères alphanumériques supplémentaires).";
            private const TITLE_APE = "Veuillez entrer un code APE valide (4 chiffres suivis d'une lettre).";
            private const TITLE_SELECT_NUM = "Veuillez sélectionner une valeur valide (chiffres uniquement).";
            private const TITLE_SELECT_STR = "Veuillez sélectionner une valeur valide (lettres, chiffres, espaces et caractères spéciaux autorisés).";



        /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

        /* ▂ ▅ ▆ █ Attributs █ ▆ ▅ ▂ */
            private array $config = [
                                'id' => [
                                    'regex' => self::REGEX_ID,
                                    'title' => self::TITLE_ID
                                ],
                                'identifiant' => [
                                    'regex' => self::REGEX_IDENTIFIANT,
                                    'title' => self::TITLE_IDENTIFIANT
                                ],
                                'password' => [
                                    'regex' => self::REGEX_PASSWORD,
                                    'title' => self::TITLE_PASSWORD
                                ],
                                'email' => [
                                    'regex' => self::REGEX_EMAIL,
                                    'title' => self::TITLE_EMAIL
                                ],
                                'phone' => [
                                    'regex' => self::REGEX_PHONE,
                                    'title' => self::TITLE_PHONE
                                ],
                                'address' => [
                                    'regex' => self::REGEX_ADDRESS,
                                    'title' => self::TITLE_ADDRESS
                                ],
                                'postal_code' => [
                                    'regex' => self::REGEX_POSTAL_CODE,
                                    'title' => self::TITLE_POSTAL_CODE
                                ],
                                'city' => [
                                    'regex' => self::REGEX_CITY,
                                    'title' => self::TITLE_CITY
                                ],
                                'text' => [
                                    'regex' => self::REGEX_TEXT,
                                    'title' => self::TITLE_TEXT
                                ],
                                'number' => [
                                    'regex' => self::REGEX_NUMBER,
                                    'title' => self::TITLE_NUMBER
                                ],
                                'date' => [
                                    'regex' => self::REGEX_DATE,
                                    'title' => self::TITLE_DATE
                                ],
                                'datetime' => [
                                    'regex' => self::REGEX_DATETIME,
                                    'title' => self::TITLE_DATETIME
                                ],
                                'url' => [
                                    'regex' => self::REGEX_URL,
                                    'title' => self::TITLE_URL
                                ],
                                'textarea' => [
                                    'regex' => self::REGEX_TEXTAREA,
                                    'title' => self::TITLE_TEXTAREA
                                ],
                                'custom' => [
                                    'regex' => self::REGEX_CUSTOM,
                                    'title' => self::TITLE_CUSTOM
                                ],
                                'customStrict' => [
                                    'regex' => self::REGEX_CUSTOM_STRICT,
                                    'title' => self::TITLE_CUSTOM_STRICT
                                ],
                                'customLoose' => [
                                    'regex' => self::REGEX_CUSTOM_LOOSE,
                                    'title' => self::TITLE_CUSTOM_LOOSE
                                ],
                                'siret' => [
                                    'regex' => self::REGEX_SIRET,
                                    'title' => self::TITLE_SIRET
                                ],
                                'siren' => [
                                    'regex' => self::REGEX_SIREN,
                                    'title' => self::TITLE_SIREN
                                ],
                                'iban' => [
                                    'regex' => self::REGEX_IBAN,
                                    'title' => self::TITLE_IBAN
                                ],
                                'bic' => [
                                    'regex' => self::REGEX_BIC,
                                    'title' => self::TITLE_BIC
                                ],
                                'ape' => [
                                    'regex' => self::REGEX_APE,
                                    'title' => self::TITLE_APE
                                ],
                                'select_num' => [
                                    'regex' => self::REGEX_SELECT_NUM,
                                    'title' => self::TITLE_SELECT_NUM
                                ],
                                'select_str' => [
                                    'regex' => self::REGEX_SELECT_STR,
                                    'title' => self::TITLE_SELECT_STR
                                ]
                            ];

        /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

        /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */
            public function __construct( array $config = [] ) {
                # We merge the default config with the provided config, allowing for overrides
                $this -> config = array_merge($this -> config, $config);
            }

            /** @return array */
            public function getConfig() : array {
                return $this -> config;
            }

            /* ▂ ▅ ▆ █ Getters █ ▆ ▅ ▂ */
            /** @return string */
            public function getRegex(string $key) : string {
                return $this -> config[$key]['regex'] ?? '';
            }

            /** @return string */
            public function getPattern(string $key) : string {
                // Remove the starting and ending slashes from the regex pattern
                return substr($this -> config[$key]['regex'] ?? '', 1, -1);
            }

            /** @return string */
            public function getTitle(string $key) : string {
                return $this -> config[$key]['title'] ?? '';
            }

            /** @return int */
            public function getMinLength(string $key) : int {
            preg_match('/\{(\d+),?(\d*)\}/', substr($this -> config[$key]['regex'] ?? '',1), $matches);
                if (isset($matches[1]) && $matches[1] !== '') {
                    return intval($matches[1]);
                }
                return 0; // Default min value if not specified
            }

            /** @return int */
            public function getMaxLength(string $key) : int {
            preg_match('/\{(\d+),?(\d*)\}/', substr($this -> config[$key]['regex'] ?? '',1), $matches);
                if (isset($matches[2]) && $matches[2] !== '') {
                    return intval($matches[2]);
                }
                return 255; // Default max value if not specified
            }

        /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    }

?>
