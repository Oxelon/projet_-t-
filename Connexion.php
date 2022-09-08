<?php
session_start();
include ("Classes/User.php");
try {
    // ---------------Connexion à la BDD et récupération et traitement du formulaire
    $pdo = new PDO('mysql:host=mysql-suard.alwaysdata.net;dbname=suard_projet', 'suard', 'lucifer8000512');
} catch (Exception  $error) {
    $error->getMessage();
}

//pour éviter les redirections vers cette page 
//je ferais un include là ou j'en ai besoin
$User1 = new User(null,$pdo);

if(isset($_POST["btnConnexion"])){
    $User1->seConnecter($_POST["login"],$_POST["mdp"]);
}
if(!$User1->isConnect()){
    ?>
    <form action="" method="post" >    
        <label for="login">login: </label>
        <input type="text" name="login" id="login" required value="Julien">

        <label for="vie">mdp: </label>
        <input type="password" name="mdp" id="mdp" required value="1234">

        <input type="submit" name="btnConnexion" value="Connect toi">
    </form>
<?php 
$User1 = null;
}else{
    $User1->getUserByID($_SESSION['idUser']);
    $User1->afficheUser();
    ?>
     <li><a href="CRUD/location/CRUD_Create.php">Creer un User</a></li>
    <?php
}
?>