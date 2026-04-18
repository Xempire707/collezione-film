<?php
require __DIR__ . "/../db.php";

header('Content-Type: application/json');

$email = trim($_POST['email'] ?? '');

if (!$email) {
    echo json_encode(['exists' => false]);
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM utenti WHERE email = ?");
$stmt->execute([$email]);

$exists = $stmt->rowCount() > 0;

echo json_encode(['exists' => $exists]);
