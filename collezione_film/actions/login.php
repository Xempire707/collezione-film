<?php
session_start();
require "../db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!$email || !$password) {
        header("Location: ../index.php?error=campi");
        exit;
    }

    $stmt = $pdo->prepare(
        "SELECT id, password FROM utenti WHERE email = ?"
    );
    $stmt->execute([$email]);
    $utente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utente && password_verify($password, $utente['password'])) {
        $_SESSION['user_id'] = $utente['id'];
        header("Location: ../form_film.php");
        exit;
    } else {
        header("Location: ../index.php?error=credenziali");
        exit;
    }
}