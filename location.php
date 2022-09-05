<?php

class Location{
    private $id_;
    private $voiture_;
    private $PDO_ ;
    private $nom_;
    private $date_;
    //permet de faire la relation 1-N
    //entre un User qui peut avoir N Arme


    public function __construct($id,$nom,$voiture,$date,$PDO){
        $this->id_=$id;
        $this->nom_ = $nom;
        $this->PDO_ = $pdo;
        $this->voiture_ = $voiture;
        $this->date_ = $date;
       
    }
    public function getAlllocation(){
        
        $sql = "select * from location";
        $reponses = $this->PDO_->query($sql);
        $Tableaulocation = array();
        while ($donnees = $reponses->fetch())
        {
            //ORM je met les infos du tuple ( issu de la bdd)
            //dans un nouvel objet Arme que je stock dans un tableau de PErso
            $location = new Location($donnees['id'],$donnees['nom'],$donnees['voiture'],$donnees['date'],$this->PDO_);

            //ON Stock tous les Armes dans un tableau pour l'utiliser dans notre page
            array_push($Tableaulocation,$location);
        } 

        return $Tableaulocation;
    }
    
    public function getId(){
        return $this->id_;
    }
    
    public function getDate(){
        return $this->date_;
    }
    public function getVoiture(){
        return $this->voiture_;
    }
    public function getnom(){
        return $this->nom_;
    }

    public function getLocationById($id){
        $sql = "select * from location where id ='".$id."'";
        $reponses = $this->PDO_->query($sql);
        $donnees = $reponses->fetch();
        $this->id_ =  $donnees['id'];
        $this->voiture_ = $donnees['voiture'];
        $this->nom_ = $donnees['nom'];
        $this->date_= $donnees['date'];
    }
    
    public function saveInBdd(){
        if(is_null($this->id_) ){
            $sql = "INSERT INTO `location` 
            (`id`, `date`, `nom`, `voiture`)
            VALUES 
            (NULL, '".$this->date_."', '".$this->nom_."', '".$this->voiture_."');";
            $reponses = $this->PDO_->query($sql);
            $this->id_ = $this->PDO_->lastInsertId();
        }else{
            $sql = "UPDATE `location` SET 
            `voiture`='".$this->voiture_."',
            `nom`='".$this->nom_."',
            `date`='".$this->date_."',
            WHERE
            `id` = '".$this->id_."'";
            $reponses = $this->PDO_->query($sql);
        }

    }
    public function delete(){
        //1 cas INSERT si id = null
        if(!is_null($this->id_) ){
            $sql = "DELETE FROM `location` 
            WHERE
            `id` = '". $this->id_."'
            ";
            //echo $sql ;
            $reponses = $this->PDO_->query($sql);
            $this->id_ = null;
        }
    }
}

?>