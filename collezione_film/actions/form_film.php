<?php
session_start();
require __DIR__ . "/../db.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$id_utente = $_SESSION['user_id'];

$stmt = $pdo->prepare(
    "SELECT f.* FROM film f
     INNER JOIN utenti_film uf ON f.id = uf.id_film
     WHERE uf.id_utente = ?"
);
$stmt->execute([$id_utente]);
$film = $stmt->fetchAll(PDO::FETCH_ASSOC);