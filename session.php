<?php

    //  GESTION DE LA BASE
        $mabase = null;
        $access = null;
        $errorMessage="";
        try{
            $user = "lapro_site";
            $pass = "TDataSource1234";
            $mabase = new PDO('mysql:host=mysql-suard.alwaysdata.net;dbname=suard_projet', 'suard', 'luifer8000512');
        }catch(Exception $e){
            $errorMessage .= $e->getMessage();
        }
        $user1 = new User($mabase); 

    //  GESTION DES SESSIONS
        if(!is_null($mabase)){
            if (isset($_SESSION["Connected"]) && $_SESSION["Connected"]===true){
                $access = true;
                if(isset($_SESSION["idUser"])){
                    $Joueur1->setUserById($_SESSION["idUser"]);
                }
            }else{
                $access = false;
            // Affichage de formulaire si pas deconnexion
                $access = $Joueur1->ConnectToi();
            }
        }else{
            $errorMessage.= "Le site n'a pas accès à la BDD.";
        }
?>