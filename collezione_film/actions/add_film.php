<?php
session_start();
require __DIR__ . "/../db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome'] ?? '');
    $anno = trim($_POST['anno'] ?? '');
    $regista = trim($_POST['regista'] ?? '');
    $voto = trim($_POST['voto'] ?? '');

    if (!$nome || !$anno || !$regista || !$voto) {
        header("Location: ../form_film.php?error=campi");
        exit;
    }

    // Inserisci il film
    $stmt = $pdo->prepare(
        "INSERT INTO film (nome, anno, regista, voto)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$nome, $anno, $regista, $voto]);
    $id_film = $pdo->lastInsertId();

    // Collega il film all'utente
    $stmt_link = $pdo->prepare(
        "INSERT INTO utenti_film (id_utente, id_film)
         VALUES (?, ?)"
    );
    $stmt_link->execute([$_SESSION['user_id'], $id_film]);

    header("Location: ../form_film.php?success=1");
    exit;
}

header("Location: ../form_film.php");
exit;
