<?php 
session_start();
include ("location.php");
include ("User.php");

try {
    // ---------------Connexion à la BDD et récupération et traitement du formulaire
    $pdo = new PDO('mysql:host=mysql-suard.alwaysdata.net;dbname=suard_projet', 'suard', 'luifer8000512');
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
    <h1> CRUD De location </h1>
    <h2>(CREATE Insert) </h2>
    <?php
        //vérification de la connexion
        $user1 = new User(null,null,null,$pdo);
        if(!$user1 -> isConnect()){
            ?>
            <li><a href="Connexion.php">Connect toi </a></li>
           <?php
        }else{
            $user1->afficheUser();
        }

        //Traitetement du formulaire
        if(isset($_POST['btnValider'])){
            //le nouveau Arme est créer avec sa relation 1N avec le User
            //en effet on rajoute id du User dans le Arme pour indiquer que c'est le Arme du user
            $location1 = new location(
                null, //id
                $_POST['nom'],
                $pdo,
                $_POST['date'],
                $_POST['voiture'],
                );

            $location1->saveInBdd(); //voir la méthode saveInBdd dans l'objet Arme
        }
        
        //Formulaire HTML
        //je dois avoir $id,$nom,$vie,$forceAttaque,$pdo,$image
        // id sera null car il n'est pas encore en BDD
        ?>

        <form action="" method="post" >
      
            <label for="nom">nom: </label>
            <input type="text" name="nom" id="nom" required value="Arme1">

            <label for="vie">date: </label>
            <input type="text" name="date" id="date" required value="date">

            <label for="forceAttaque">voiture: </label>
            <input type="text" name="voiture" id="voiture" value="name" required>
       
            <input type="submit" name="btnValider" value="Creer le Arme">
        
        </form>


        <?php
        
       //--------------------READ-------------
        $location1 = new location(null,null,$pdo,null,null,);
        $tablocation = $location1->getAlllocation();
        echo "<ul>";
        foreach ($tablocation as $location) {
            echo "<li>";
            echo $location->getid();
            echo "</li>";
        }
        echo "</ul>";
        
    ?>
</body>
</html>