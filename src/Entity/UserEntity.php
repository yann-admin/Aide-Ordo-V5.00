<?php
	declare(strict_types=1);
	/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
		/* Fichier Entities database: api_chichoune - table: user via constructor_Array_DataBase_SQL.php VERSION: 3.0.0*/
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
		namespace App\src\Entity;
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
		class UserEntity{

			/* ▂ ▅ Constants ▅ ▂ */
			/* ▂▂▂▂▂▂▂▂▂▂▂ */
			
			/* ▂ ▅ Attributs ▅ ▂ */
				private ?int $idUserAccount;
				private string $userName;
				private string $userFirstName;
				private string $userEmail;
				private string $userRecoveryCode;
				private int $userLevel;
				private string $userIdentifiant;
				private string $userPassword;
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

			
            /* ▂ ▅ Methodes ▅ ▂ */
				/* ▂ ▅  construct  ▅ ▂ */
					public function __construct( $config=[] ) {
						$this->idUserAccount = $config['idUserAccount'] ?? null;
						$this->userName = $config['userName'] ?? '';
						$this->userFirstName = $config['userFirstName'] ?? '';
						$this->userEmail = $config['userEmail'] ?? '';
						$this->userRecoveryCode = $config['userRecoveryCode'] ?? '';
						$this->userLevel = $config['userLevel'] ?? 0;
						$this->userIdentifiant = $config['userIdentifiant'] ?? '';
						$this->userPassword = $config['userPassword'] ?? '';

					}

				/* ▂ ▅  hydrate($donnees)  ▅ ▂ */
					/**  @return UserEntity */
					public static function hydrate( array $data) : self {
						return new UserEntity([
							'idUserAccount' => $data['idUserAccount'] ?? null,
							'userName' => $data['userName'] ?? '',
							'userFirstName' => $data['userFirstName'] ?? '',
							'userEmail' => $data['userEmail'] ?? '',
							'userRecoveryCode' => $data['userRecoveryCode'] ?? '',
							'userLevel' => $data['userLevel'] ?? 0,
							'userIdentifiant' => $data['userIdentifiant'] ?? '',
							'userPassword' => $data['userPassword'] ?? '',
						]);
					}

				/* ▂ ▅  Getters  ▅ ▂ */
					public function getIdUserAccount(): ?int { return $this->idUserAccount;}
					public function getUserName(): string { return $this->userName;}
					public function getUserFirstName(): string { return $this->userFirstName;}
					public function getUserEmail(): string { return $this->userEmail;}
					public function getUserRecoveryCode(): string { return $this->userRecoveryCode;}
					public function getUserLevel(): int { return $this->userLevel;}
					public function getUserIdentifiant(): string { return $this->userIdentifiant;}
					public function getUserPassword(): string { return $this->userPassword;}

				/* ▂ ▅  Setters  ▅ ▂ */
					public function setIdUserAccount(int $modifIdUserAccount) : self { $this->idUserAccount = $modifIdUserAccount; return $this; }		
					public function setUserName(string $modifUserName) : self { $this->userName = $modifUserName; return $this; }
					public function setUserFirstName(string $modifUserFirstName) : self { $this->userFirstName = $modifUserFirstName; return $this; }
					public function setUserEmail(string $modifUserEmail) : self { $this->userEmail = $modifUserEmail; return $this; }
					public function setUserRecoveryCode(string $modifUserRecoveryCode) : self { $this->userRecoveryCode = $modifUserRecoveryCode; return $this; }
					public function setUserLevel(int $modifUserLevel) : self { $this->userLevel = $modifUserLevel; return $this; }
					public function setUserIdentifiant(string $modifUserIdentifiant) : self { $this->userIdentifiant = $modifUserIdentifiant; return $this; }
					public function setUserPassword(string $modifUserPassword) : self { $this->userPassword = $modifUserPassword; return $this; }

				/* ▂ ▅  readtoArray() : array  ▅ ▂ */
					/* @ return array */
					public function readtoArray() : array {
						return [
							'idUserAccount' => $this->idUserAccount,
							'userName' => $this->userName,
							'userFirstName' => $this->userFirstName,
							'userEmail' => $this->userEmail,
							'userRecoveryCode' => $this->userRecoveryCode,
							'userLevel' => $this->userLevel,
							'userIdentifiant' => $this->userIdentifiant,
							'userPassword' => $this->userPassword,
						];
					}

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

		}
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>