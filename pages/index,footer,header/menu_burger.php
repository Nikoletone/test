<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_menu-burge.css">
    <title>Navigation Menu</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="submit.php">Ajouter un article</a></li>
            <?php endif; ?>
            <li><a href="tout_articles.php">Blog</a></li>
            <li><a href="CV_Nikauly_Dejesus_vizcaino.pdf">CV</a></li>
            <li><a href="contact.php">contact</a></li>
        </ul>
        <?php if (isset($_SESSION['user_id'])): ?>
            <form method="post" action="">
                <input type="submit" name="deconnecter" value="Déconnecter">
            </form>
            <?php
                if (isset($_POST["deconnecter"])) {
                    session_destroy();
                    header("Location: index.php");
                    exit();
                }
            ?>
        <?php else: ?>
            <form method="post" action="">
                <input type="submit" name="connecter" value="Connecter">
            </form>
            <?php
                if (isset($_POST["connecter"])) {
                    header("Location: connection.php");
                    exit();
                }
            ?>
        <?php endif; ?>
    </nav>
    <button type="button" aria-label="toggle curtain navigation" class="nav-toggler">
        <span class="line l1"></span>
        <span class="line l2"></span>
        <span class="line l3"></span>
    </button>
</header>
<script src="test.js"></script>
</body>
</html>