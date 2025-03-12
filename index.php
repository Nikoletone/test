<?php
session_start();

require_once 'connection_BDD.php';

$user_name = "Bienvenue"; // Valeur par défaut

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE id = :id");
    $stmt->execute(['id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $user_name = "Bonjour " . htmlspecialchars($user['prenom']);
    } else {
        $user_name = 'Bonjour';
        session_destroy();
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_ind.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>Accueil</title>
</head>
<body>
    <header>
        <?php require 'menu_burger.php'?>
    </header>
    <main>
        <div class="container">
            <p class="text"><?= $user_name ?></p> <!-- Afficher le message approprié -->
        </div>
        <h2 class="titre-article">Articles récents</h2>
        <ul class="art">
            <?php
            $requette_selection = $conn->prepare('SELECT * FROM articles ORDER BY date_publication DESC, id DESC LIMIT 3;');
            $requette_selection->execute();
            $requette_selection->setFetchMode(PDO::FETCH_OBJ);
            $listes_acticles = $requette_selection->fetchAll();
            ?>
            <?php foreach($listes_acticles as $liste_article): ?>
                <li>
                    <h2><?= htmlspecialchars($liste_article->titre) ?></h2>
                    <p><?= htmlspecialchars(substr($liste_article->contenu, 0, 100)) ?>.....</p>
                    <p class="categorie">Catégorie: <?= htmlspecialchars($liste_article->categorie) ?></p>
                    <p><?= htmlspecialchars($liste_article->date_publication) ?></p>
                    <a href="article.php?id=<?= $liste_article->id ?>">Voir plus</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
    <?php require_once 'footer.php';?>
</body>
</html>