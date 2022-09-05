
<?php include ("location.php");

try {
    // ---------------Connexion à la BDD et récupération et traitement du formulaire
    $pdo = new PDO('mysql:host=mysql-suard.alwaysdata.net;dbname=suard_projet', 'UserWeb', 'UserWeb');
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
    $location1 = new location(null,null,$pdo,null,null);
    if(isset($_GET['btnSupprimer'])){
        $location1->getLocationById($_GET['idlocation']);
        $location1->delete();
    }

    //--------------------Choix Arme-------------
    $tablocation = $location1->getAlllocation();
    ?>
    <form action="" method="get">
        <select id="idlocation" name="idlocation">
            <?php
            foreach ($tablocation as  $Thelocation) {
                echo '<option value="'.$Thelocation->getId().'">'.$Thelocation->getnom().'</option>';
            }
            ?>
        </select>
        <input type="submit" value="Supprimer cette location" name="btnSupprimer">
    </form>

    <?php
    //Formulaire HTML de modification -------------------------------------
    //je dois avoir $id,$nom,$date,$voiture,$pdo
    // id sera caché car il est utilisé pour la condition where de l'update
    ?>
 

    <?php 
    $tablocation = $location1->getAlllocation();
    echo "<ul>";
    foreach ($tablocation as $location) {
        echo "<li>";
        echo $location->getId();
        echo "</li>";
    }
    echo "</ul>";     
    ?>
  
</body>
</html>