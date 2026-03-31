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
        namespace App\src\Core\Database;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

        # Class PDO & Exception & Throwable
        use \PDO, \Throwable, \PDOStatement, \Exception;

        # Class DbConnectSql
        use App\src\Core\Database\DbConnectSql;

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        abstract class RequestManager {
            /* ▂ ▅ Constants ▅ ▂ */
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */
                protected PDO $connexion;
            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅ construct ▅ ▂ */
                    public function __construct(){
                        $this -> connexion = DbConnectSql::getConnection();
                    }

                    /* ▂ ▅ executeRequest ▅ ▂ */
                    /**  @param string $prepare requête SQL préparée */
                    /**  @param array $params paramètres de la requête préparée */
                    /**  @return PDOStatement résultat de la requête préparée  Le \ signifie classe globale PHP car PDOStatement est dans le namespace global.*/
                    /**  @throws Exception en cas d'erreur de la base de données */
                    /**  @throws Throwable en cas d'erreur inattendue */
                    /**  Cette méthode exécute une requête SQL préparée avec les paramètres fournis et retourne le résultat sous forme de PDOStatement. En cas d'erreur de la base de données, elle lance une exception avec un message d'erreur détaillé. En cas d'erreur inattendue, elle lance une exception générique avec le message de l'erreur. */
                    protected function executeRequest(string $prepare, array $params = []): PDOStatement{
                        try {
                            $request = $this -> connexion -> prepare($prepare);
                            $request -> execute($params);
                            return $request;
                        } catch (Throwable $e) {
                            error_log( $e -> getMessage() . " in " . $e -> getFile() . " on line " . $e -> getLine() );
                            throw new Exception("Unexpected error: " . $e -> getMessage());
                        }

                    }

                    /* ▂ ▅ fetchAll() ▅ ▂ */
                    /**  @param string $prepare requête SQL préparée */
                    /**  @param array $params paramètres de la requête préparée */
                    /**   @return array résultat de la requête préparée */
                    protected function fetchAll(string $prepare, array $params = []): array{
                        $request = $this -> executeRequest($prepare, $params);
                        $result = $request -> fetchAll(PDO::FETCH_ASSOC) ?? [];
                        $request -> closeCursor();
                        return $result;
                    }

                     /* ▂ ▅ fetchOne() ▅ ▂ */
                    /**  @param string $prepare requête SQL préparée */
                    /**  @param array $params paramètres de la requête préparée */
                    /**   @return array résultat de la requête préparée */
                    protected function fetchOne(string $prepare, array $params = []): ?array{
                        $request = $this -> executeRequest($prepare, $params);
                        $result = $request-> fetch(PDO::FETCH_ASSOC) ?: null;
                        $request -> closeCursor();
                        return $result;
                    }

                    /* ▂ ▅  isEntriesExist()  ▅ ▂ */
                    /**  @param string $prepare requête SQL préparée */
                    /**  @param array $params paramètres de la requête préparée */
                    /**   @return bool résultat de la requête préparée */
                    protected function isEntriesExist(string $prepare, array $params = []): int{
                        $request = $this -> executeRequest($prepare, $params);
                        $result = $request -> fetchColumn() ?? 0;
                        $request -> closeCursor();
                        return $result;
                    }


            /* ▂▂▂▂▂▂▂▂▂▂▂ */


            

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>
