<?php
echo "Chargement Class User";
class User{

    private $id_;
    private $isAdmin_ = false;
    private $login_;

    public function __construct($id, $isAdmin, $login){
        $this->id_=$id;
        $this->isAdmin_=$isAmdin;
        $this->login_=$login;
    }

    public function seConnecter($login,$pass){
        $RequetSql = "SELECT * FROM 'User' WHERE 'login' = '".$login."' AND 'pass' = '".$pass."';";

        $resultats = $GLOBALS["pdo"]->query($RequetSql);
        if ($resultats->rowCount()>0){
            $_SESSION['Connexion']=true;
            $tab = $resultats->fetch();

            $this->id_=$tab['id'];
            $this->isAdmin_=$tab['isAdmin'];
            $this->login_=$tab['login'];

            echo $tab['id']." ".$tab['login']." ".$tab['isAdmin'];
            return true;
        }else{
            return false;
        }
    }


    public function isAdmin(){
        return $this->isAdmin;
    }

    public function getLogin(){
        return $this->$login_;
    }
    public function CreateNewUser($login,$pass){
       
        $RequetSql = "SELECT * FROM `User` 
        WHERE 
        `login` = '".$login."'";
        $resultat = $GLOBALS["pdo"]->query($RequetSql); 
        if ( $resultat->rowCount()>0){
            //echo "on a trouver le bon id";
            $tab = $resultat->fetch();
            $this->id_ = $tab['id'];
            $this->isAdmin_ = $tab['isAdmin'];
            $this->login_ = $tab['login'];
            $pass =  $tab['pass'];
            
        }else{
            //Générer un mdp temporaire pour ce user si $pass est vide
            if(empty($pass)){
                $temp= password_hash($login, PASSWORD_DEFAULT);
                $pass=substr($temp, 13, 3).substr($temp, 23, 3).substr($temp, 33, 3).'!';
            }
            $requetSQL = "INSERT INTO `User`
            ( `login`, `pass`, `isAdmin`) 
            VALUES 
            ('" . $login . "','" . $pass . "','0')";
            $resultat = $GLOBALS["pdo"]->query($requetSQL);
            $this->id_ = $GLOBALS["pdo"]->lastInsertId();
            $this->isAdmin_ = 0;
            $this->login_ = $login;
        }
        //envoyer un mail de confirmation avec login et mdp
        try {
            // Plusieurs destinataires
             $to  = $this->login_; // notez la virgule
             // Sujet
             $subject = 'Bienvenu sur TP Note Film';
             // message
             $message = '<html><head><title>Bienvenu sur TP Note Film</title></head>
             <body>
             <p style=" background-image: url(\'https://getwallpapers.com/wallpaper/full/9/3/7/1267865-movie-poster-wallpaper-1920x1080-for-mobile-hd.jpg\') ;height:180px;color:white;text-align: center;font-size: 100px;">TP NOTE SITE</p>
             <p><h2 style="color:black" >Voici votre login : '.$this->login_.'<h2></p>
             <p><h3 style="color:black">Voici votre mdp temporaire : '.$pass.' <h3></p></body>
             <p style="height:40px;background-color:#ffc107;color:black;text-align: center;font-size: 15px;">
                Copyright © Rapidecho / Pour maitriser ce que vous faites inspirez vous mais ne faites pas de copier/coller
             </p>
             </html>';
             // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
             $headers[] = 'MIME-Version: 1.0';
             $headers[] = 'Content-type: text/html; charset=utf-8';
             // En-têtes additionnels
             $headers[] = 'To:  <'.$to.'>';
             $headers[] = 'From: TP Note Film <no-reply@sendinblue.com>';
             //copie 
             //$headers[] = 'Cc: jlanglace@la-providence.net';
             //copie caché
                 //$headers[] = 'Bcc: jlanglace@la-providence.net';

             // Envoi ( cette fonction est bloquante privilégié un appel API)
             mail($to, $subject, $message, implode("\r\n", $headers));
         } catch (Exception  $error) {
             $error->getMessage();
         }
    }
}

