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
        namespace App\src\Renderer;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class MenuRenderer{

            /* ▂ ▅ Constants ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅ ▆ █ render ( ) █ ▆ ▅ ▂ */
                /** @param array<MenuItem> $items */
                /** @param int $userLevel */
                /** @return string */
                public function render(array $items, int $userLevel): string
                {
                    return $this->renderItems($items, $userLevel) ;
                }

                /* ▂ ▅ ▆ █ renderItems ( ) █ ▆ ▅ ▂ */
                /** @param array<MenuItem> $items */
                /** @param int $userLevel */
                /** @return string */
                private function renderItems(array $items, int $userLevel): string
                {
                    $html = [];
                    foreach ($items as $item) {

                        if (!$item->canAccess($userLevel)) {
                            continue;
                        }

                        if ($item->hasChildren()) {
                            $html[] = '<li class="nav-item dropdown">';
                            $html[] = '<a class="nav-link dropdown-toggle" href="'.$item->getUrl().'" data-bs-toggle="dropdown">';
                            $html[] = '<i class="me-2 '.$item->getIcon().'"></i>'.$item->getTitle();
                            $html[] = '</a>';
                            $html[] = '<ul class="dropdown-menu ps-4">';

                            $html[] = $this->renderItems($item->getChildren(), $userLevel);

                            $html[] = '</ul></li>';

                        } else {
                            $html[] = '<li class="nav-item">';
                            $html[] = '<a class="nav-link" href="'.$item->getUrl().'">';
                            $html[] = '<i class="me-2 '.$item->getIcon().'"></i>'.$item->getTitle();
                            $html[] = '</a></li>';
                        }
                    }

                    return implode("\n", $html);
                }


            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
    
?>
