<?php
include "connexion.php";
include "User.php";
class DemandeRep  
{
    private $id;
    private $dateD;
    private $statut;
    private $des;
    private $idEquip;
    private $idUser;
    function  __construct($id, $dateD, $statut,$des, $idEquip, $idUser)
    {
        $this->id = $id;
        $this->dateD = $dateD;
        $this->statut = $statut;
        $this->des = $des;
        $this->idEquip = $idEquip;
        $this->idUser = $idUser;
    }
    function __get($att)
    {
        if (!isset($this->$att)) return "erreur. Attribut non défini pour l'objet! <br>";
        return $this->$att;
    }
    function __set($att, $val)
    {
        $this->$att = $val;
    }
    function __isset($att)
    {
        return isset($this->$att);
    }
    function __toString()
    {
        $ch1 = "<tr><td>$this->id</td><td>$this->dateD</td><td>$this->statut</td><td>$this->des</td><td>$this->idEquip</td>";
        
        return $ch1;
    }
    function ajouterDemands()
    {
        global $bdd;
        try {
            $stmt = $bdd->prepare("INSERT INTO demande_reparation(id, date_demande, statut,description,	id_equipement ,id_employe) VALUES(:id, :dateD, :statut,:des, :idEquip,:idUser)");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':dateD', $this->dateD);
            $stmt->bindParam(':statut', $this->statut);
            $stmt->bindParam(':des', $this->des);
            $stmt->bindParam(':idEquip', $this->idEquip);
            $stmt->bindParam(':idUser', $this->idUser);
            // insertion d'un article
            $stmt->execute();
            $stmt->closeCursor();
            // lier l'article à ses  fournisseurs
            if ($stmt->rowCount() > 0)
                $stmt1 = $bdd->prepare("UPDATE equipement SET statut='hors service' WHERE id = :idEquip") ;         
                $stmt1->bindParam(':idEquip',$this->idEquip);
                $stmt1->execute();
                $stmt1->closeCursor();
                if ($stmt1->rowCount() > 0)
                    return true;
            else return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    function modifierDemands()
    {
        global $bdd;
        try {
        $stmt=$bdd->prepare("UPDATE demande_reparation SET date_demande = :dateD, statut = :statut,description=:des, id_equipement =:idEquip,id_employe=:idUser WHERE id = :id") ;
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':dateD',$this->dateD);
        $stmt->bindParam(':statut',$this->statut);
        $stmt->bindParam(':des', $this->des);
        $stmt->bindParam(':idEquip',$this->idEquip);
        $stmt->bindParam(':idUser', $this->idUser);
      
        $stmt->execute();
        $stmt->closeCursor();
        if ($stmt->rowCount() > 0)
                return true;
            else return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    function rejeterDemands()
    {
        global $bdd;
        try {
        $stmt=$bdd->prepare("UPDATE demande_reparation SET date_demande = :dateD, statut = :statut WHERE id = :id") ;
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':statut',$this->statut);
        $stmt->bindParam(':dateD',$this->dateD);
      
        $stmt->execute();
        $stmt->closeCursor();
        if ($stmt->rowCount() > 0)
                return true;
            else return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    function modifierDemandsU()
    {
        global $bdd;
        try {
        $stmt=$bdd->prepare("UPDATE demande_reparation SET date_demande = :dateD,description=:des, id_equipement =:idEquip WHERE id = :id and statut='en attente'") ;
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':dateD',$this->dateD);
      
        $stmt->bindParam(':des', $this->des);
        $stmt->bindParam(':idEquip',$this->idEquip);
      
        $stmt->execute();
        $stmt->closeCursor();
        if ($stmt->rowCount() > 0)
                return true;
            else return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    function supprimerDemands()
    {
        global $bdd;
        $stmt = $bdd->prepare("DELETE FROM demande_reparation WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $stmt->closeCursor();

        if ($stmt->rowCount() > 0)
            return true;
        else return false;
    }
    public static function getDemands($desR,$idUser)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id, date_demande, statut,description,	id_equipement ,id_employe FROM demande_reparation WHERE lower(description) like lower(:des) and id_employe=:idU ");
            $desres="%$desR%";
            $stmt->bindParam(':idU', $idUser);
            $stmt->bindParam(':des', $desres);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_demande', $dateD);
            $stmt->bindColumn('statut', $statut);
            $stmt->bindColumn('description', $des);
            $stmt->bindColumn('id_equipement', $idEquip);
            $stmt->bindColumn('id_employe', $idUser);
            $tabDemand=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabDemand,new DemandeRep($id,$dateD,$statut,$des,$idEquip,$idUser));
            }
           
            $stmt->closeCursor();
            return $tabDemand;
           
       
    }
    public static function getDemandsADD($desR)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id, date_demande, statut,description,	id_equipement ,id_employe FROM demande_reparation WHERE lower(description) like lower(:des)  ");
            $desres="%$desR%";
            $stmt->bindParam(':des', $desres);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_demande', $dateD);
            $stmt->bindColumn('statut', $statut);
            $stmt->bindColumn('description', $des);
            $stmt->bindColumn('id_equipement', $idEquip);
            $stmt->bindColumn('id_employe', $idUser);
            $tabDemand=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabDemand,new DemandeRep($id,$dateD,$statut,$des,$idEquip,$idUser));
            }
           
            $stmt->closeCursor();
            return $tabDemand;
           
       
    }
    public static function getDemandsADDT($desR,$idTech)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id, date_demande, statut,description,	id_equipement ,id_employe FROM demande_reparation D join demande_technicien T on D.id=T.id_demande WHERE lower(description) like lower(:des) and T.id_technicien=:idTech ");
            $stmt->bindParam(':idTech', $idTech);
            $desres="%$desR%";
            $stmt->bindParam(':des', $desres);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_demande', $dateD);
            $stmt->bindColumn('statut', $statut);
            $stmt->bindColumn('description', $des);
            $stmt->bindColumn('id_equipement', $idEquip);
            $stmt->bindColumn('id_employe', $idUser);
            $tabDemand=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabDemand,new DemandeRep($id,$dateD,$statut,$des,$idEquip,$idUser));
            }
           
            $stmt->closeCursor();
            return $tabDemand;
           
       
    }
    public static function getDemandsALLT($idTech)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id, date_demande, statut,description,	id_equipement ,id_employe FROM demande_reparation D join demande_technicien T on D.id=T.id_demande WHERE  T.id_technicien=:idTech ");
            $stmt->bindParam(':idTech', $idTech);
            
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_demande', $dateD);
            $stmt->bindColumn('statut', $statut);
            $stmt->bindColumn('description', $des);
            $stmt->bindColumn('id_equipement', $idEquip);
            $stmt->bindColumn('id_employe', $idUser);
            $tabDemand=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabDemand,new DemandeRep($id,$dateD,$statut,$des,$idEquip,$idUser));
            }
           
            $stmt->closeCursor();
            return $tabDemand;
           
       
    }
    public static function getDemandUserAFF($id,$idUserR)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id, date_demande, statut,description,	id_equipement ,id_employe FROM demande_reparation WHERE id=:id and id_employe=:iduser");
            
            $stmt->bindParam(':iduser', $idUserR);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_demande', $dateD);
            $stmt->bindColumn('statut', $statut);
            $stmt->bindColumn('description', $des);
            $stmt->bindColumn('id_equipement', $idEquip);
            $stmt->bindColumn('id_employe', $idUser);
            
            $stmt->fetch(PDO::FETCH_BOUND);
            if ($stmt->rowCount() ==1){
                $d=new DemandeRep($id,$dateD,$statut,$des,$idEquip,$idUser);
                return $d;
            }
            else 
            {return null;}
        $stmt->closeCursor();
            
         
    }
    public static function getDemandUserAFA($id)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id, date_demande, statut,description,	id_equipement ,id_employe FROM demande_reparation WHERE id=:id ");
            
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_demande', $dateD);
            $stmt->bindColumn('statut', $statut);
            $stmt->bindColumn('description', $des);
            $stmt->bindColumn('id_equipement', $idEquip);
            $stmt->bindColumn('id_employe', $idUser);
            
            $stmt->fetch(PDO::FETCH_BOUND);
            if ($stmt->rowCount() ==1){
                $d=new DemandeRep($id,$dateD,$statut,$des,$idEquip,$idUser);
                return $d;
            }
            else 
            {return null;}
        $stmt->closeCursor();
            
         
    }
    public static function getDemandUser($idUserR)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id, date_demande, statut,description,	id_equipement ,id_employe FROM demande_reparation WHERE id_employe=:iduser");
            
            $stmt->bindParam(':iduser', $idUserR);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_demande', $dateD);
            $stmt->bindColumn('statut', $statut);
            $stmt->bindColumn('description', $des);
            $stmt->bindColumn('id_equipement', $idEquip);
            $stmt->bindColumn('id_employe', $idUser);
            $tabDemand=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabDemand,new DemandeRep($id,$dateD,$statut,$des,$idEquip,$idUser));
            }
           
            $stmt->closeCursor();
            return $tabDemand;
         
    }
    public static function getDemandUserAll()
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id, date_demande, statut,description,	id_equipement ,id_employe FROM demande_reparation ");
            
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_demande', $dateD);
            $stmt->bindColumn('statut', $statut);
            $stmt->bindColumn('description', $des);
            $stmt->bindColumn('id_equipement', $idEquip);
            $stmt->bindColumn('id_employe', $idUser);
            $tabDemand=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabDemand,new DemandeRep($id,$dateD,$statut,$des,$idEquip,$idUser));
            }
           
            $stmt->closeCursor();
            return $tabDemand;
    }
}

?>