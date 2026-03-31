<?php
    declare(strict_types=1);
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        namespace App\src\Core\Database;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

        # Class PDO & Throwable & Exception
        use \PDO, \Throwable, \Exception;

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █    Class    █ ▆ ▅ ▂ */
        abstract class DbConnectSql{
            /* ▂ ▅ Constants ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */
                private static ?PDO $pdoConnection = null;
            /* ▂▂▂▂▂▂▂▂▂▂▂ */


            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅  createConnection() ▅ ▂ */
                    private static function createConnection() : void {
                        try{
                            self::$pdoConnection = new PDO("mysql:host=" . $_ENV["DB_HOST"] .";dbname=" . $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASS"]);
                            #Activation des erreurs PDO:
                            self::$pdoConnection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            #Les retours de requete seront en tableau objet par défaut:
                            self::$pdoConnection -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                            #Encodage des caractères spéciaux "utf-8":
                            self::$pdoConnection -> setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
                        } catch ( Throwable $e ){
                            throw new Exception("Database connection error");
                        }
                    }

                /* ▂ ▅ getConnection ▅ ▂ */
                    public static function getConnection(): PDO {
                        if (self::$pdoConnection === null) {
                            self::createConnection();
                        }
                        return self::$pdoConnection;
                    }


        }
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>
