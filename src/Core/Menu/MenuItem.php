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
        namespace App\src\Core\Menu;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class MenuItem {

            /* ▂ ▅ Constants ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */
                private string $title;
                private string $url;
                private string $icon;
                private int $level;

                /** @var MenuItem[] */
                private array $children = [];
            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅ __construct ▅ ▂ */
                public function __construct( string $title, string $url='#', string $icon='fa-solid fa-circle', int $level=0) {
                    $this->title = $title;
                    $this->url = $url;
                    $this->icon = $icon;
                    $this->level = $level;
                }


                /* ▂ ▅ __construct ▅ ▂ */
                /** @param MenuItem $item */
                /** @return $this */
                public function addChild(MenuItem $item): self{
                    $this->children[] = $item;
                    return $this;
                }

                /* ▂ ▅ __construct ▅ ▂ */
                /** @return bool */
                public function hasChildren(): bool{
                    return !empty($this->children);
                }

                /* ▂ ▅ __construct ▅ ▂ */
                /** @return MenuItem[] */
                public function getChildren(): array{
                    return $this->children;
                }

                /* ▂ ▅ __construct ▅ ▂ */
                /** @param int $userLevel */
                /** @return bool */
                public function canAccess(int $userLevel): bool{
                    return $userLevel >= $this->level;
                }






                /* ▂ ▅ __construct ▅ ▂ */
                /** @return string */
                public function getTitle(): string{
                    return htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
                }

                /* ▂ ▅ __construct ▅ ▂ */
                /** @return string */
                public function getUrl(): string{
                    return htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
                }

                /* ▂ ▅ __construct ▅ ▂ */
                /** @return string */
                public function getIcon(): string{
                    return htmlspecialchars($this->icon, ENT_QUOTES, 'UTF-8');
                }



            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
    
?>
