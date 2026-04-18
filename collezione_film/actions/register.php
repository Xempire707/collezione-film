<?php
session_start();
require "../db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST['nome']);
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    if (!$nome || !$email || !$password) {
        header("Location: ../register.php?error=campi");
        exit;
    }

    // valida formato email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=email_format");
        exit;
    }

    $check = $pdo->prepare("SELECT id FROM utenti WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        header("Location: ../register.php?error=email");
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare(
        "INSERT INTO utenti (nome, email, password)
         VALUES (?, ?, ?)"
    );
    try {
        $stmt->execute([$nome, $email, $hash]);
        $user_id = $pdo->lastInsertId();
    } catch (PDOException $e) {
        // log dell'eccezione per debug
        @file_put_contents(__DIR__ . '/reg_debug.log', date('[Y-m-d H:i:s] ') . 'PDOException: ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
        // 1062 = duplicate entry
        $errNo = $e->errorInfo[1] ?? null;
        if ($errNo == 1062) {
            header("Location: ../register.php?error=email");
            exit;
        }
        // rilancia se non è un duplicate (per non nascondere altri problemi)
        throw $e;
    }

    // Autentica automaticamente l'utente
    $_SESSION['user_id'] = $user_id;

    header("Location: ../form_film.php?success=registered");
    exit;
}