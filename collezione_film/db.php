<?php
$host = "127.0.0.1";
$dbname = "collezione_film";
$user = "root";
$pass = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=3307;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );

    // errori visibili (utile per debug)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $e) {
    die("Errore DB: " . $e->getMessage());
}