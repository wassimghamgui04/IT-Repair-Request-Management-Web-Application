<?php
include "connexion.php";
include_once "Equipement.php";
class Intervention  
{
    private $id;
    private $idDem;
    private $idTech;
    private $dateI;
    private $des;

    public function __construct($id , $idDem , $idTech , $dateI , $des )
    {
        $this->id = $id;
        $this->idDem = $idDem;
        $this->idTech = $idTech;
        $this->dateI = $dateI;
        $this->des = $des;
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
        $ch1 = "<tr><td>$this->id</td><td>$this->dateD</td><td>$this->statut</td><td>$this->idEquip</td><td>$this->idUser</td>";
        //Affichage des ids des fournisseurs
        

        // $ch1 .= "</tr>";
        return $ch1;
    }
    function ajouterInter()
    {
        global $bdd;
        try {
            $stmt = $bdd->prepare("INSERT INTO intervention(id, id_demande, id_technicien,date_intervention,commentaire ) VALUES(:id, :idDem, :idTech,:dateI,:des)");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':idDem', $this->idDem);
            $stmt->bindParam(':idTech', $this->idTech);
            $stmt->bindParam(':dateI', $this->dateI);
            $stmt->bindParam(':des', $this->des);
            // insertion d'un article
            $stmt->execute();
            $stmt->closeCursor();
            // lier l'article à ses  fournisseurs
            if ($stmt->rowCount() > 0)
            {    $stmt1=$bdd->prepare("SELECT * FROM intervention WHERE id_demande = :idDem") ;
                $stmt1->bindParam(':idDem', $this->idDem);
                $stmt1->execute();
                $stmt1->closeCursor();
                $stmt2=$bdd->prepare("SELECT * FROM demande_technicien WHERE id_demande = :idDem") ;
                $stmt2->bindParam(':idDem', $this->idDem);
                $stmt2->execute();
                $stmt2->closeCursor();
                if($stmt1->rowCount() == $stmt2->rowCount())
                {
                    $stmt3 = $bdd->prepare("UPDATE demande_reparation SET statut = :statut WHERE id = :idDem");
                    $stmt3->bindParam(':idDem', $this->idDem);
                    $statut="résolue";
                    $stmt3->bindParam(':statut', $statut);
                    $stmt3->execute();
                    $stmt3->closeCursor();
                    $stmt4=$bdd->prepare("SELECT id_equipement FROM demande_reparation WHERE id = :idDemandR");
                $stmt4->bindParam(':idDemandR', $this->idDem);
                $stmt4->execute();
                $stmt4->bindColumn('id_equipement', $idEquipement);
                $stmt4->fetch(PDO::FETCH_BOUND);
                $stmt4->closeCursor();
                Equipement::ModStatutF($idEquipement);
                }
                else
                {
                    $stmt3 = $bdd->prepare("UPDATE demande_reparation SET statut = :statut WHERE id = :idDem");
                    $stmt3->bindParam(':idDem', $this->idDem);
                    $statut="en cours";
                    $stmt3->bindParam(':statut', $statut);
                    $stmt3->execute();
                    $stmt3->closeCursor();
                }
                return true;
            }else return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    function modifierInter()
    {
        global $bdd;
        try {
        $stmt=$bdd->prepare("UPDATE intervention SET id_demande = :idDem, id_technicien = :idTech, date_intervention =:dateI, commentaire=:des WHERE id = :id") ;
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':idDem', $this->idDem);
        $stmt->bindParam(':idTech', $this->idTech);
        $stmt->bindParam(':dateI', $this->dateI);
        $stmt->bindParam(':des', $this->des);

      
        $stmt->execute();
        $stmt->closeCursor();
        if ($stmt->rowCount() > 0)
                return true;
            else return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    function supprimerInter()
    {
        global $bdd;
        $stmt = $bdd->prepare("DELETE FROM intervention WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $stmt->closeCursor();

        if ($stmt->rowCount() > 0)
            return true;
        else return false;
    }
    public static function getInterventions($desR)
    {
        global $bdd;
        $stmt = $bdd->prepare("SELECT id, date_intervention, commentaire, id_demande, id_technicien FROM intervention WHERE lower(commentaire) LIKE lower(:des)");

        $desres="%$desR%";
            $stmt->bindParam(':des', $desres);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_intervention', $dateI);
            $stmt->bindColumn('commentaire', $des);
            $stmt->bindColumn('id_demande', $idDem);
            $stmt->bindColumn('id_technicien', $idTech);

            $tabInter=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabInter,new Intervention($id,$idDem,$idTech,$dateI,$des));
            }
           
            $stmt->closeCursor();
            return $tabInter;
           
       
    }
    public static function getInterventionsT($desR, $idTechT)
    {
        global $bdd;
        $stmt = $bdd->prepare("SELECT id, date_intervention, commentaire, id_demande, id_technicien FROM intervention WHERE lower(commentaire) LIKE lower(:des) and id_technicien = :idTech");
        

        $desres="%$desR%";
            
            $stmt->bindParam(':idTech', $idTechT);
            $stmt->bindParam(':des', $desres);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_intervention', $dateI);
            $stmt->bindColumn('commentaire', $des);
            $stmt->bindColumn('id_demande', $idDem);
            $stmt->bindColumn('id_technicien', $idTech);

            $tabInter=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabInter,new Intervention($id,$idDem,$idTech,$dateI,$des));
            }
           
            $stmt->closeCursor();
            return $tabInter;
           
       
    }
    public static function getInterventionsAll()
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id, date_intervention, commentaire, id_demande, id_technicien FROM intervention ");
            
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_intervention', $dateI);
            $stmt->bindColumn('commentaire', $des);
            $stmt->bindColumn('id_demande', $idDem);
            $stmt->bindColumn('id_technicien', $idTech);
            $tabInter=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabInter,new Intervention($id,$idDem,$idTech,$dateI,$des));
            }
           
            $stmt->closeCursor();
            return $tabInter;
    }
    public static function getIntervention($id)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id, date_intervention, commentaire, id_demande, id_technicien FROM intervention WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_intervention', $dateI);
            $stmt->bindColumn('commentaire', $des);
            $stmt->bindColumn('id_demande', $idDem);
            $stmt->bindColumn('id_technicien', $idTech);
            
            if ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                return new Intervention($id,$idDem,$idTech,$dateI,$des);
            } else {
                return null;
            }
            
            $stmt->closeCursor();
        
    }
    public static function getInterventionByDemande($idDem)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id, date_intervention, commentaire, id_demande, id_technicien FROM intervention WHERE id_demande = :idDem");
            $stmt->bindParam(':idDem', $idDem);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_intervention', $dateI);
            $stmt->bindColumn('commentaire', $des);
            $stmt->bindColumn('id_demande', $idDem);
            $stmt->bindColumn('id_technicien', $idTech);
            
            if ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                return new Intervention($id,$idDem,$idTech,$dateI,$des);
            } else {
                return null;
            }
            
            $stmt->closeCursor();
        
    }
    public static function getInterventionByTechnicien($idTechen)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id, date_intervention, commentaire, id_demande, id_technicien FROM intervention WHERE id_technicien = :idTech");
            $stmt->bindParam(':idTech', $idTechen);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('date_intervention', $dateI);
            $stmt->bindColumn('commentaire', $des);
            $stmt->bindColumn('id_demande', $idDem);
            $stmt->bindColumn('id_technicien', $idTech);
            
            $tabInter=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabInter,new Intervention($id,$idDem,$idTech,$dateI,$des));
            } 
            
            $stmt->closeCursor();
            return $tabInter;
    }

}

?>