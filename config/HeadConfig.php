<?php
    declare(strict_types=1);

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        namespace App\Config;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
    Class HeadConfig{

        /* ▂ ▅ Constants ▅ ▂ */
        /* ▂▂▂▂▂▂▂▂▂▂▂▂ */

        /* ▂ ▅ Attributs ▅ ▂ */
            protected string $title;
            protected string $charset;
            protected string $author;
            protected string $keywords;
            protected string $description;
            protected string $favicon;
            protected string $initialCss;
            protected string $initialJs;
            /** @var array<string> */
            protected array $additionalCss = [];
            /** @var array<string> */
            protected array $additionalJs = [];
        /* ▂▂▂▂▂▂▂▂▂▂▂▂ */

        /* ▂ ▅ Methodes ▅ ▂ */

            /* ▂ ▅ __construct ▅ ▂ */
            /** @return void */
            public function __construct( array $configHead = [] ) {
                    # french:On utilise l'opérateur de coalescence nulle pour assigner les dépendances ou créer de nouvelles instances si elles ne sont pas fournies
                    # english: We use the null coalescing operator to assign dependencies or create new instances if they are not provided
                    # if it exist and is not null, we use it, otherwise we create a new instance of the class
                    $this -> title = $configHead["title"] ?? "Aide-Ordo - Accueil";
                    $this -> charset = $configHead["charset"] ?? "UTF-8";
                    $this -> author = $configHead["author"] ?? "MT-Dev: Yann MARTIN";
                    $this -> keywords = $configHead["keywords"] ?? "aide, ordonnancement, projet, gestion, tâches, ressources";
                    $this -> description = $configHead["description"] ?? "Aide-Ordo est une application d'aide à l'ordonnancement de projet qui permet de gérer les tâches, les ressources et les délais de manière efficace.";
                    $this -> favicon = $configHead["favicon"] ?? "assets/ImagesApp/LogoChichoune50x50.png";
                    $this -> initialCss = $configHead["initialCss"] ?? "assets/css/base.css";
                    $this -> initialJs = $configHead["initialJs"] ?? "assets/js/base.js";
                    $this -> additionalCss = $configHead["additionalCss"] ?? [];
                    $this -> additionalJs = $configHead["additionalJs"] ?? [];
            }

            /* ▂ ▅  Setters  ▅ ▂ */
            /**  @return self  = Class actuelle */
            public function setTitle(string $title) : self { $this -> title = $title; return $this; }
            public function setCharset(string $charset) : self { $this -> charset = $charset; return $this; }
            public function setAuthor(string $author) : self { $this -> author = $author; return $this; }
            public function setKeywords(string $keywords) : self { $this -> keywords = $keywords; return $this; }
            public function setDescription(string $description) : self { $this -> description = $description; return $this; }
            public function setFavicon(string $favicon) : self { $this -> favicon = $favicon; return $this; }
            public function setInitialCss(string $initialCss) : self { $this -> initialCss = $initialCss; return $this; }
            public function setInitialJs(string $initialJs) : self { $this -> initialJs = $initialJs; return $this; }
            public function addAdditionalCss(string $data) : self { $this -> additionalCss[] = $data; return $this; }
            public function addAdditionalJs(string $data) : self { $this -> additionalJs[] = $data; return $this; }


            /* ▂ ▅  Getters  ▅ ▂ */
            /**  @return string */
            public function getTitle() : string { return $this -> title; }
            public function getCharset() : string { return $this -> charset; }
            public function getAuthor() : string { return $this -> author; }
            public function getKeywords() : string { return $this -> keywords; }
            public function getDescription() : string { return $this -> description; }
            public function getFavicon() : string { return $this -> favicon; }
            public function getInitialCss() : string { return $this -> initialCss; }
            public function getInitialJs() : string { return $this -> initialJs; }
            public function getAdditionalCss() : array { return $this -> additionalCss; }
            public function getAdditionalJs() : array { return $this -> additionalJs; }

            /* ▂ ▅  toArray()  ▅ ▂ */
            /** @return array */
            public function toArray() :array{
                return [
                    'title' => $this->title,
                    'charset' => $this->charset,
                    'author' => $this->author,
                    'keywords' => $this->keywords,
                    'description' => $this->description,
                    'favicon' => $this->favicon,
                    'initialCss' => $this->initialCss,
                    'initialJs' => $this->initialJs,
                    'additionalCss' => $this->additionalCss,
                    'additionalJs' => $this->additionalJs,
                ];
            }

            /* ▂ ▅  hydrate()  ▅ ▂ */
            /**  @return :void */
            public function hydrate( array $donnees):void {
                foreach ($donnees as $attribut => $valeur){
                    if (in_array($attribut, ['additionalCss', 'additionalJs'], true)) {
                        $this->hydrateArrayAttribute($attribut, $valeur);
                    } else {
                        $this->hydrateSingleAttribute($attribut, $valeur);
                    }
                }
            }

            /* ▂ ▅ hydrateArrayAttribute()  ▅ ▂ */
            /**  @return :void */
            private function hydrateArrayAttribute(string $attribut, mixed $valeur): void {
                $method = 'add' . ucfirst($attribut);
                if (!method_exists($this, $method)) {
                    return;
                }
                if (is_array($valeur)) {
                    foreach ($valeur as $item) {
                        if (is_string($item)) {
                            $this->$method($item);
                        }
                    }
                } else {
                    if (is_string($valeur)) {
                        $this->$method($valeur);
                    }
                }
            }

            /* ▂ ▅  hydrateSingleAttribute()  ▅ ▂ */
            /**  @return :void */
            private function hydrateSingleAttribute(string $attribut, mixed $valeur): void {
                $method = 'set' . ucfirst($attribut);
                if (method_exists($this, $method) && is_string($valeur)) {
                    $this->$method($valeur);
                }
            }
        /* ▂▂▂▂▂▂▂▂▂▂▂▂ */
    }





?>
