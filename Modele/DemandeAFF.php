<?php
include "connexion.php";
require_once "DemandeRep.php";
require_once "User.php";
require_once "Equipement.php";
class DemandeAff  
{
    private $idDemandR;
    private $idTech;
    
    function  __construct($idDemandR, $idTech)
    {
        $this->idDemandR = $idDemandR;
        $this->idTech = $idTech;
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
        $ch1 = "<tr><td>$this->idDemandR</td><td>$this->idTech</td></tr>";
        //Affichage des ids des fournisseurs
        

        // $ch1 .= "</tr>";
        return $ch1;
    }
    function affecterDemand()
    {
        global $bdd;
        try {
            $stmt = $bdd->prepare("INSERT INTO demande_technicien (id_demande,id_technicien) VALUES(:idDemandR, :idTech)");
            $stmt->bindParam(':idDemandR', $this->idDemandR);
            $stmt->bindParam(':idTech', $this->idTech);
            // insertion d'un article
            $stmt->execute();
            $stmt->closeCursor();
            // lier l'article à ses  fournisseurs
            if ($stmt->rowCount() > 0)
            {   
                $stmt2 = $bdd->prepare("UPDATE demande_reparation SET statut = :statut WHERE id = :idDemandR");
                $stmt2->bindParam(':idDemandR', $this->idDemandR);
                $statut="Attribuée";
                $stmt2->bindParam(':statut', $statut);
                $stmt2->execute();
                 $stmt2->closeCursor();
                $stmt1=$bdd->prepare("SELECT id_equipement FROM demande_reparation WHERE id = :idDemandR");
                $stmt1->bindParam(':idDemandR', $this->idDemandR);
                $stmt1->execute();
                $stmt1->bindColumn('id_equipement', $idEquipement);
                $stmt1->fetch(PDO::FETCH_BOUND);
                $stmt1->closeCursor();
                Equipement::ModStatutF($idEquipement);
                if ($stmt2->rowCount() > 0)
                    return true;
                 }
            

        } catch (PDOException $e) {
            return false;
        }
    }
    function modifierDemands()
    {
        global $bdd;
        try {
       //Version1 simple: Modifier tous les champs même s'ils sont vides
        $stmt=$bdd->prepare("UPDATE demande_technicien SET id_demande = :idDemandR, id_technicien = :idTech WHERE id_demande = :idDemandR, id_technicien = :idTech") ;
        $stmt->bindParam(':idDemandR',$this->idDemandR);
        $stmt->bindParam(':idTech',$this->idTech);
 
        // Modification d'un article
        $stmt->execute();
        $stmt->closeCursor();
        if ($stmt->rowCount() > 0)
                return true;
            else return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    function supprimerDemandAff()
    {
        global $bdd;
        $stmt = $bdd->prepare("DELETE FROM demande_technicien WHERE id_demande = :idDemandR AND id_technicien = :idTech");
        $stmt->bindParam(':idDemandR',$this->idDemandR);
        $stmt->bindParam(':idTech',$this->idTech);
        $stmt->execute();
        $stmt->closeCursor();

        if ($stmt->rowCount() > 0)
            return true;
        else return false;
    }
    public static function getDemandsAFFC($desR)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id_demande , id_technicien FROM demande_technicien T join utilisateur U on T.id_technicien=U.id WHERE (lower(id_demande) like lower(:des)) or (lower(U.nom) like lower(:des))");
            $desres="%$desR%";
            $stmt->bindParam(':des', $desres);
            $stmt->execute();
            $stmt->bindColumn('id_demande', $idDemandR);
            $stmt->bindColumn('id_technicien', $idTech);
            
            $tabDemandA=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabDemandA,new DemandeAff($idDemandR,$idTech));
            }
           
            $stmt->closeCursor();
            return $tabDemandA;
           
       
    }
    public static function getDemandsAff()
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id_demande , id_technicien FROM demande_technicien");
            
            $stmt->execute();
            $stmt->bindColumn('id_demande', $idDemandR);
            $stmt->bindColumn('id_technicien', $idTech);
            
            $tabDemandA=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabDemandA,new DemandeAff($idDemandR,$idTech));
            }
           
            $stmt->closeCursor();
            return $tabDemandA;
           
       
    }
    public static function getDemandsAffT($idTech)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id_demande , id_technicien FROM demande_technicien where id_technicien = :idTech");
            
            $stmt->bindParam(':idTech', $idTech);
            
            $stmt->execute();
            $stmt->bindColumn('id_demande', $idDemandR);
            $stmt->bindColumn('id_technicien', $idTech);
            
            $tabDemandA=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabDemandA,new DemandeAff($idDemandR,$idTech));
            }
           
            $stmt->closeCursor();
            return $tabDemandA;
           
       
    }
    public static function getDemandsAFFCT($desR, $idTechT)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id_demande , id_technicien FROM demande_technicien T join utilisateur U on T.id_technicien=U.id WHERE ((lower(id_demande) like lower(:des)) or (lower(U.nom) like lower(:des))) and T.id_technicien = :idTech");
            $desres="%$desR%";
            $stmt->bindParam(':idTech', $idTechT);
            $stmt->bindParam(':des', $desres);
            $stmt->execute();
            $stmt->bindColumn('id_demande', $idDemandR);
            $stmt->bindColumn('id_technicien', $idTech);
            
            $tabDemandA=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabDemandA,new DemandeAff($idDemandR,$idTech));
            }
           
            $stmt->closeCursor();
            return $tabDemandA;
           
       
    }
   
    
}

?>