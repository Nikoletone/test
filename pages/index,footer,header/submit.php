<?php
require_once 'connection_BDD.php';

// Définir le mode d'erreur sur l'objet de connexion PDO
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['Ajouter'])) {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $categorie = $_POST['categorie'];
    try {
        $requete_insertion = $conn->prepare('INSERT INTO articles (titre, contenu, categorie) VALUES(:titre, :contenu, :categorie)');
        $requete_insertion->execute(
            array(
                'titre' => $titre, 
                'contenu'=> $contenu,
                'categorie'=> $categorie
            )
        );
        echo "Article ajouté avec succès";
    } catch (Exception $e) {
        echo "Erreur lors de l'ajout de l'article: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_submit.css">
    <title>Submission d'articles</title>
</head>
<body>
    <fieldset>
        <form method="post" action="submit.php">
            <h2>Ajouter un article</h2>
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" required>
            <br>
            <label for="contenu">Contenu</label>
            <textarea name="contenu" id="contenu" required></textarea>
            <br>
            <label for="categorie">Catégorie</label>
            <input type="text" name="categorie" id="categorie" required>
            <br>
            <input type="submit" value="Ajouter" name="Ajouter">
            <br>
            <a href="index.php">Retour Accueil</a>
        </form>
    </fieldset>
</body>
</html>