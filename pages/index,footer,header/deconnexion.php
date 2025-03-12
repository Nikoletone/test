<?php
session_start(); // Démarrer la session

if (isset($_POST["deconnection"])) {
    session_destroy(); // Détruire la session
    header("Location: connection.php"); // Rediriger vers la page de connexion
} else {
    echo "Déconnexion non réussie";
}
?>