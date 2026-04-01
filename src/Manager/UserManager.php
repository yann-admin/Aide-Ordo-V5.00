<?php
	declare(strict_types=1);
	/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
		/* Fichier controller database: api_chichoune - table: user via constructor_Array_DataBase_SQL.php VERSION: 3.0.0*/
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
		namespace App\src\Manager;
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */

		# Class PDO
		use \PDO;

        # We include the RequestManager class to handle database requests, which is an abstract class that provides methods for executing SQL queries and fetching results
        use App\src\Core\Database\RequestManager;

		# We include the UserEntity class to represent the user data as an object, which is a class that has properties corresponding to the columns of the user table in the database and a constructor to initialize them
		use App\src\Entity\UserEntity;

	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
		class UserManager extends RequestManager {

			/* ▂ ▅ Constants ▅ ▂ */
			/* ▂▂▂▂▂▂▂▂▂▂▂ */

			/* ▂ ▅ Attributs ▅ ▂ */

			/* ▂▂▂▂▂▂▂▂▂▂▂ */

			/* ▂ ▅ Methodes ▅ ▂ */

				/* ▂ ▅  findByReferer()  ▅ ▂ */
				 /** @param string $value la valeur à rechercher dans la colonne spécifiée */
				 /** @return UserEntity|null retourne une instance de UserEntity si un utilisateur correspondant est trouvé, sinon retourne null */
				public function findByReferer( string $value) : ?UserEntity {
					$prepare = "SELECT user.* FROM user WHERE user.userIdentifiant = :value";
					$params = [':value' => $value];
					$data = $this->fetchOne($prepare, $params);

					if ($data) {
						return new UserEntity($data);
					} else {
						return null;
					}
				}

			/* ▂▂▂▂▂▂▂▂▂▂▂ */

		}
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>
