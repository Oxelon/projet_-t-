<?php
session_start();
include "Classes/Utilisateur.php";
try {
    $BDD = new PDO('mysql:host=mysql-suard.alwaysdata.net;dbname=suard_projet', 'suard', 'lucifer8000512');
} catch (Exception $e) {
    echo $e;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="Image/icone.png">
    <link rel="stylesheet" href="CSS/fichier.css">
    <title>Projet PHP</title>
</head>

<body class="index">
    <div>
        <nav class="compte">
            <ul>
                <?php
                if (!isset($_SESSION["NomUser"])) {
                    echo "<li>Actuellement non connecté</li>";
                    echo '<li><a href="PHP/connection.php">Connexion</a></li>';
                    echo '<li><a href="PHP/inscription.php">Inscription</a></li>';
                } else {
                    echo "<li>Connecté en tant que " . $_SESSION["NomUser"] . "</li>";
                    echo '<li><a href="PHP/deconnection.php">Deconnexion</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
    <h1 class="centre"><u>Bienvenue Sur mon site de location !</u></h1>
</body>

</html>