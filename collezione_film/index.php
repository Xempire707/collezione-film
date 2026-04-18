<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <main class="container">
        <h1>Benvenuto</h1>
        <p>Accedi o registrati per continuare</p>

        <form class="card" method="POST" action="actions/login.php">
            <h2>Login</h2>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="email@example.com" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>

            <button type="submit">Accedi</button>

            <p class="switch">
                Non hai un account? <a href="register.php">Registrati</a>
            </p>
        </form>
    </main>

    <script src="js/validazioni.js"></script>
</body>
</html>
