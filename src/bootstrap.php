<?php

// Autoload composer packages

use App\Connection;

require realpath(__DIR__ . '/../vendor/autoload.php');

// Load .env vars to $_ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Create DB connection
$dsn = "mysql:host=".$_ENV['DB_HOST'].";port=".$_ENV['DB_PORT'].";dbname=".$_ENV['DB_DATABASE'].";user=".$_ENV['DB_USERNAME'].";password=".$_ENV['DB_PASSWORD'];
try {
    $db = new Connection($dsn);
} catch (PDOException $e) {
    exit('Error connecting to DB');
}
