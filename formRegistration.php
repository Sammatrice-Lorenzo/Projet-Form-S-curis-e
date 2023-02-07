<?php

include 'cnx.php';
include 'utils.php';

/**
 * Cette fonction permet de vérifier les données
 *
 * @return array
 */
function customValidation(): array
{
    session_start();

    if (!isset($_SESSION['token'])) {
        return [
            'errors' => 'Problème de token veuillez ressayer',
            'success' => false
        ];
    }

    // Si aucun champs n'est rempli en sort de la fonction
    if (
        $_POST['name'] === "" ||
        $_POST['firstname'] === "" ||
        $_POST['email'] === "" ||
        $_POST['password'] === "" ||
        $_POST['confirm-password'] === ""
    ) {

        return [
            'errors' => 'Vous devez remplir tous les champs !',
            'success' => false
        ];
    }

    $errors = [];

	if (!isset($_POST['name']) || strlen($_POST['name']) > 255 || !preg_match('/^[a-zA-Z- ]+$/', $_POST['name'])) {
		$errors[] = 'Votre nom ne correspond pas aux normes';
	}

	if (!isset($_POST['email']) || strlen($_POST['email']) > 255 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'Votre mail n\'est pas correct';

	} elseif (!checkdnsrr(substr($_POST['email'], strpos($_POST['email'], '@') + 1), 'MX')) {
		$errors[] = 'Votre mail n\'est pas valide!';
	}

	if (
        !isset($_POST['password']) ||
        !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\~?!@#\$%\^&\*])(?=.{8,})/', $_POST['password'])
    ) {
		$errors[] = 'Votre mot de passe ne contient pas les caractères spéciaux!';
	}

    if ($_POST['confirm-password'] !== $_POST['password']) {
		$errors[] = 'Vos mot de passe de correspond pas';
    }

    return [
        'errors' => $errors,
        'success' => false
    ];
}

/**
 * Permet de s’enregistrer et vérifier que le compte de l'user n'existe pas déjà
 *
 * @param PDO $cnx
 */
function register(PDO $cnx): array
{
    $password = securePassword($_POST['password']);

    if (customValidation()['errors']) {
        return customValidation();
    } else {
        $sql = $cnx->prepare('SELECT * from user WHERE email = ?');
        $sql->bindValue(1, $_POST['email']);
        $sql->execute();

        if ($sql->fetch()) {
            return [
                'errors' => 'Vous avez déjà un compte veuillez vous connecter',
                'success' => false
            ];
        } else {
            $sqlInsert = $cnx->prepare('INSERT INTO user (firstname, lastname, email, password) VALUES (?, ?, ?, ?)');
            $sqlInsert->bindValue(1, $_POST['firstname']);
            $sqlInsert->bindValue(2, $_POST['name']);
            $sqlInsert->bindValue(3, $_POST['email']);
            $sqlInsert->bindValue(4, $password);
            $sqlInsert->execute();
    
            return [
                'message' => 'Vous vous êtes enregistrée',
                'success' => true
            ];
        }
    }
}

if (array_key_exists('register', $_POST)) {
    echo json_encode(register($cnx));
}
