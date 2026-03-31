<?php
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
        // ?XDEBUG_SESSION_START=1
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        #namespace=Nom du projet \ nom du dossier
        namespace App;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class Autoloader{
            /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

                /* ▂ ▅ ▆ █ register( ) █ ▆ ▅ ▂ */
                static function register( ){
                    spl_autoload_register([__CLASS__,'autoload']);
                }
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

                /* ▂ ▅ ▆ █ autoload( $class ) █ ▆ ▅ ▂ */
                static function autoload( $class ){
                    $NP= __NAMESPACE__;
                    $dir = __DIR__;
                    $class=str_replace(__NAMESPACE__.'\\','',$class);
                    $test1=$class;
                    $class=str_replace('\\','/',$class);
                    $test2=$class;
                    if(file_exists(__DIR__.'/'.$class.'.php')){
                        $test3=__DIR__.'/'.$class.'.php';
                        require __DIR__.'/'.$class.'.php';
                    }
                }
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
            }
        /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>

