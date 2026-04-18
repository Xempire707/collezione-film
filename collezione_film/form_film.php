<?php
require __DIR__ . "/actions/form_film.php";
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h1>La tua collezione 🎬</h1>

    <!-- FORM INSERIMENTO FILM -->
    <form method="POST" action="actions/add_film.php" class="card">
        <h2>Aggiungi film</h2>

        <input type="text" name="nome" placeholder="Titolo del film" required>
        <input type="number" name="anno" placeholder="Anno" required>
        <input type="text" name="regista" placeholder="Regista" required>
        <input type="number" name="voto" min="1" max="10" placeholder="Voto (1-10)" required>

        <button type="submit">Salva</button>
    </form>

    <!-- ELENCO FILM -->
    <div class="card">
        <h2>I tuoi film</h2>

        <?php if (count($film) === 0): ?>
            <p>Nessun film inserito.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($film as $f): ?>
                    <li>
                        <strong><?= htmlspecialchars($f['nome']) ?></strong>
                        (<?= $f['anno'] ?>) – <?= htmlspecialchars($f['regista']) ?>
                        | ⭐ <?= $f['voto'] ?>/10
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <a href="actions/logout.php">Logout</a>

</div>

<script src="js/validazioni.js"></script>
</body>
</html>