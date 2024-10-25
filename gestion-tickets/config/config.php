<?php
// Configuration de la base de données
define('DB_HOST', 'localhost'); // hôte de la base de donnée
define('DB_USER', 'USERNAME');  // nom d'utilisateur de la base de donnée
define('DB_PASS', 'PASSWORD');  // mot de passe de la base de donnée
define('DB_NAME', 'gestion_tickets'); // nom de la base de donnée

try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
