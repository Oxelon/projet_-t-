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

    public function seDeConnecter(){

    }

    public function isAdmin(){
        return $this->isAdmin;
    }

    public function getLogin(){
        return $this->$login_;
    }
}

