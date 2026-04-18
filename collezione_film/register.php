<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<main class="container">
    <h1>Registrazione</h1>
    <p>Crea il tuo account</p>

    <form class="card" method="POST" action="actions/register.php">
        <label>Nome</label>
        <input type="text" name="nome" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button name="register">Registrati</button>
        <a href="index.php" class="back-link">← Torna al login</a>
    </form>
</main>

<script src="js/validazioni.js"></script>
</body>
</html>