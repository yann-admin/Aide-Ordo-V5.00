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
        class MenuBuilder{

            /* ▂ ▅ Constants ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */


            /* ▂ ▅ buildMenu ( ) ▅ ▂ */
            /** @return array<MenuItem> */
            public static function buildMenu(): array {
                return [

                    new MenuItem('Accueil', 'home', 'fa-solid fa-house', 0),

                    (new MenuItem('Mon compte', '#', 'fa-solid fa-user', 1))->addChild(new MenuItem('Profil', 'account/profile', 'fa-solid fa-id-card', 1)),

                    (new MenuItem('Mes usines', 'factory', 'fa-solid fa-building', 2)),

                    (new MenuItem('Gestion des lignes', 'line', 'fa-solid fa-industry', 3)),
          
                    $topologie = (new MenuItem('Topologie', '#', 'fa-solid fa-cogs', 2))
                        ->addChild(new MenuItem('Mes topologies', 'topologie', 'fa-solid fa-cog', 3))
                        ->addChild(new MenuItem('Mes pièces de format', 'piece-format', 'fa-solid fa-cogs', 3)),

                    $production = (new MenuItem('Production', '#', 'fa-solid fa-box', 2))
                        ->addChild(new MenuItem('Mes productions', 'production', 'fa-solid fa-boxes', 3))


                ];
            }

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
    
?>
