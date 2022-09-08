<?php include ("location.php");

try {
    $pdo = new PDO('mysql:host=mysql-suard.alwaysdata.net;dbname=suard_projet', 'suard', 'lucifer8000512');
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
    if(isset($_GET['btnModifier'])){
        $location1->getlocationById($_GET['idlocation']);
    }

    if(isset($_POST['btnConfirmerUpdate'])){
        $location1 = new location(
            $_POST['idlocation'], 
            $_POST['voiture'],
            $pdo;
            $_POST['nom'],
            $_POST['date'],
            
        );
        $location1->saveInBdd(); //voir la méthode saveInBdd dans l'objet Location
    }

    
    $tablocation = $location1->getAlllocation();
    ?>
    <form action="" method="get">
        <select id="idlocation" name="idlocation">
            <?php
            foreach ($tablocation as  $Thelocation) {
                echo '<option value="'.$Thelocation->getId().'">'.$Thelocation->getdate().'</option>';
            }
            ?>
        </select>
        <input type="submit" value="Choix de la voiture" name="btnModifier">
    </form>

    <?php
    //Formulaire HTML de modification -------------------------------------
    //je dois avoir $id,$nom,$date,$voiture,$pdo
    // id sera caché car il est utilisé pour la condition where de l'update
    ?>

    <form action="" method="post" >
    
        <label for="nom">nom: </label>
        <input type="text" name="nom" id="nom" required value="<?php echo $location1->getnom(); ?>">

        <label for="voiture">Voiture : </label>
        <input type="text" name="vie" id="vie" required value="<?php echo $location1->getVoiture(); ?>">

        <label for="date">Dates : </label>
        <input type="text" name="forceAttaque" id="forceAttaque" value="<?php echo $location1->getdate(); ?>" required>

        <!-- le champ hidden permet de mettre un id dans un input caché-->
        <input type="Hidden" name="idArme" id="idArme" required value="<?php echo $location1->getId(); ?>">
       
        <input type="submit" name="btnConfirmerUpdate" value="Confirmer l'Update">
    
    </form>

    <?php 
    if(!is_null($location1->getId())){
        echo $location1->getnom();
    }      
    ?>
  
</body>
</html>