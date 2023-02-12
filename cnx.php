<?php
    // Page de connexion avec la bbd
    $servername = 'db';
    $username = 'root';
    $password = 'password';
    $dbname = 'formsecure';
    $port = '3306';

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
