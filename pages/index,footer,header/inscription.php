<?php
require_once 'connection_BDD.php';

if (isset($_POST['Inscription'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hachage du mot de passe

    try {
        $requete_insertion = $conn->prepare('INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) VALUES(:nom, :prenom, :email, :mot_de_passe)');
        $requete_insertion->execute(
            array(
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'mot_de_passe' => $pass
            )
        );
        echo "<script>alert('Inscription réussie');</script>";
        header("Location: connection.php");
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style_inscription.css">
</head>
<body>
    
        
        <form action="" method="post">
            <legend>Inscription</legend>
                <div>
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" required class="inputs">
                </div>
                <br>
                <div>
                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" id="prenom" required class="inputs">
                </div>
                <br>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required class="inputs">
                </div>
                <br>
                <div>
                    <label for="mot_de_passe">Mot de passe</label>
                    <input type="password" name="mot_de_passe" id="mot_de_passe" required class="inputs">
                </div>
                <br>
                <div>
                    <input type="submit" value="Inscription" name="Inscription" id="submit"> 
                </div>
                <p>Si vous etes déja incrit <a href="connection.php"> connecter vous </a></p>
            
        </form>
   
</body>
</html>