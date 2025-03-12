<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$servername = "localhost";
$username = "root";
$password1 = "";
$dbname = "mini_blog";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password1);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES utf8");
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if ($user && password_verify($password, $user->mot_de_passe)) {
            // Régénération de l'ID de session pour plus de sécurité
            session_regenerate_id(true);
            
            $_SESSION['user_id'] = $user->id;
            $_SESSION['prenom'] = $user->prenom;
            
            // Redirection absolue recommandée
            header('Location: index.php');
            exit();
        } else {
            $error_message = "Email ou mot de passe incorrect";
        }
    } else {
        $error_message = "Veuillez remplir tous les champs";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style_co.css">
</head>
<body>
    <?php if ($error_message): ?>
        <div >
            <?= htmlspecialchars($error_message) ?>
        </div>
    <?php endif; ?>
    
        
    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
      <legend>Connexion Administrateur</legend> 
       <div >
            <label for="email">Email </label>
            <input type="email" id="email" name="email" required 
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" class="inputs">
        </div>
        
        <div >
            <label for="password">Mot de passe </label>
            <input type="password" id="password" name="password" required class="inputs">
        </div>

        <div >
            <input type="submit" value="Se connecter" id="submit">
        </div>
    </form>
    
</body>
</html>