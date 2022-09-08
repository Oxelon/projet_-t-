<?php 
session_start();
include ("../../Classes/Arme.php");
include ("../../Classes/User.php");

try {
    // ---------------Connexion à la BDD et récupération et traitement du formulaire
    $pdo = new PDO('mysql:host=suard.alwaysdata.net;dbname=suard_projet', 'suard', 'lucifer8000512');
} catch (Exception  $error) {
    $error->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>CRUD</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php
        //vérification de la connexion
        $user1 = new User(null,$pdo);
        if(!$user1 -> isConnect()){
            ?>
            <li><a href="Connexion.php">Connect toi </a></li>
           <?php
        }else{
            $user1->afficheUser();
        }

        //Traitetement du formulaire
        if(isset($_POST['btnValider'])){
            //la nouvelle location est créer avec sa relation 1N avec le User
            $location1 = new location(
                null, //id
                $_POST['nom'],
                $pdo,
                $_POST['voiture'],
                $_POST['date'],
                );

            $location1->saveInBdd(); //voir la méthode saveInBdd dans l'objet location
        }
        
        //Formulaire HTML
        // id sera null car il n'est pas encore en BDD
        ?>

        <form action="" method="post" >
      
            <label for="nom">nom: </label>
            <input type="text" name="nom" id="nom" required value="location1">

            <label for="vie">voiture : </label>
            <input type="text" name="voiture" id="voiture" required value="voiture">

            <label for="date">date: </label>
            <input type="text" name="date" id="date" value="date" required>
       
            <input type="submit" name="btnValider" value="Creer le Arme">
        
        </form>


        <?php
        
       //--------------------READ-------------
        $location1 = new location(null,null,$pdo,null,null);
        $tablocation = $location1->getAlllocation();
        echo "<ul>";
        foreach ($tablocation as $location) {
            echo "<li>";
            echo $location->getAllinfo();
            echo "</li>";
        }
        echo "</ul>";
        
    ?>
</body>
</html>