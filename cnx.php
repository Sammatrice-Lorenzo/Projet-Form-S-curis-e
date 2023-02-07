<?php
    // Page de connexion avec la bbd
    require_once realpath('./vendor/autoload.php');
    use Dotenv\Dotenv;

    $dotenvlocal = Dotenv::createImmutable(__DIR__, '.env.local');
    $dotenvlocal->load();

    $servername = $_ENV['SERVER'];
    $username = $_ENV['USER_NAME'];
    $password = $_ENV['PASSWORD_BD'];
    $dbname = $_ENV['DB_NAME'];
    $port = $_ENV['PORT'];

    try {
        $cnx = new PDO(
            "mysql:host=$servername;port=$port;dbname=$dbname",
            $username,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
       echo 'Connection failed: ' . $e->getMessage();
    }
