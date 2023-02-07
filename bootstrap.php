<?php

// include './vendor/autoload.php';
require_once realpath('./vendor/autoload.php');

use Dotenv\Dotenv;

$dotenvlocal = Dotenv::createImmutable(__DIR__, '.env.local');
$dotenvlocal->load();

function base64UrlEncode($text)
{
    return str_replace(
        ['+', '/', '='],
        ['-', '_', ''],
        base64_encode($text)
    );
}