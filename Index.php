<?php include ("Classes/User.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php include ("session.php");

    if(isset($_SESSION['Connexion'])){
    ?>

        <h1> Index </h2>
        <div> Bienvenu <?php echo $TheUser->getLogin()?></div>
    <?php
    }
    ?>

</body>
</html>