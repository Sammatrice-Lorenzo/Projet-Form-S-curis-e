<?php

include 'cnx.php';

/**
 * Permet d'ecrypeter le mot de passe envoyer en paramètre
 *
 * @param string $inputPassword
 * @return string
 */
function securePassword(string $inputPassword): string
{
    $timeTarget = 0.05; // 50 millisecondes

    $cost = 8;
    do {
        $cost++;
        $start = microtime(true);
        $password = password_hash($inputPassword, PASSWORD_BCRYPT, ["cost" => $cost]);
        $end = microtime(true);
    } while (($end - $start) < $timeTarget);

    return $password;
}

/**
 * Permet de se connecter et voir si l’utilisateur existe
 *
 * @param PDO $cnx
 * @return array
 */
function login(PDO $cnx): array
{
    $errors = [];
    $success = false;

    session_start();

    if (!isset($_SESSION['token'])) {
        $errors[] = 'Problème de token veuillez ressayer';
    }

    if ($_POST['email'] === "" || $_POST['password'] === "") {
        $errors[] = 'Vous devez remplir tous les champs !';
    }

    if (!isset($_POST['email']) || strlen($_POST['email']) > 255 ||
        !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    ) {
		$errors[] = 'Votre mail n\'est pas correct';

	} elseif (!checkdnsrr(substr($_POST['email'], strpos($_POST['email'], '@') + 1), 'MX')) {
		$errors[] = 'Votre mail n\'est pas valide!';
	}

	if (
        !isset($_POST['password']) ||
        !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\~?!@#\$%\^&\*])(?=.{8,})/', $_POST['password'])
    ) {
		$errors[] = 'Votre mot de passe ne semble pas être dans la norme';
	}

    if ($errors) {
        return [
            'errors' => $errors,
            'success' => $success
        ];
    }

    $sqlPassword = $cnx->prepare('SELECT password FROM user WHERE email = ?');
    $sqlPassword->bindValue(1, $_POST['email']);
    $sqlPassword->execute();

    if ($sqlPassword->rowCount() == 1) {
        $passwordLogin = password_verify($_POST['password'], $sqlPassword->fetch()['password']);
        if ($passwordLogin) {
            $msg = "Vous êtes connecté";
            $success = true;
        } else {
            $errors[] = 'Votre mot de passe est incorrecte';
        }
    } else {
        $errors[] = 'Vous n\'avez pas de compte veuillez vous enregistrez';
    }

    return [
        'errors' => $errors,
        'success' =>  $success ? true : false,
        'message' => $msg ?? ""
    ];
}

/**
 * Permet de créer un token pour sécuriser la connexion ou l’encastrement
 *
 * @return string
 */
function generateToken(): string
{
    return bin2hex(random_bytes(32));
}

if (array_key_exists('login', $_POST)) {
    echo json_encode(login($cnx));
}
