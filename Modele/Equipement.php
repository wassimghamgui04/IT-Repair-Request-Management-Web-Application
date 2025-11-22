<?php
include "connexion.php";
class Equipement  
{
    private $id;
    private $nom;
    private $type;
    private $statut;
    private $idUser;
    function  __construct($id, $nom, $type, $statut, $idUser)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->type = $type;
        $this->statut = $statut;
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
        $ch1 = "<tr><td>$this->id</td><td>$this->nom</td><td>$this->type</td><td>$this->statut</td></tr>";
        //Affichage des ids des fournisseurs
        

        // $ch1 .= "</tr>";
        return $ch1;
    }
    
    function ajouterEquips()
    {
        global $bdd;
        try {
            $stmt = $bdd->prepare("INSERT INTO equipement(id, nom, type,statut,id_utilisateur) VALUES(:id, :nom, :type, :statut,:idUser)");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':statut', $this->statut);
            $stmt->bindParam(':idUser', $this->idUser);
            // insertion d'un article
            $stmt->execute();
            $stmt->closeCursor();
            // lier l'article à ses  fournisseurs
            if ($stmt->rowCount() > 0)
                return true;
            else return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    function modifierEquips()
    {
        global $bdd;
        try {
       //Version1 simple: Modifier tous les champs même s'ils sont vides
        $stmt=$bdd->prepare("UPDATE equipement SET nom = :nom, type = :type, statut =:statut,id_utilisateur=:idUser WHERE id = :id") ;
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':nom',$this->nom);
        $stmt->bindParam(':type',$this->type);
        $stmt->bindParam(':statut',$this->statut);
        $stmt->bindParam(':idUser', $this->idUser);
      
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
    function supprimerEquips()
    {
        global $bdd;
        $stmt = $bdd->prepare("DELETE FROM equipement WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $stmt->closeCursor();

        if ($stmt->rowCount() > 0)
            return true;
        else return false;
    }
    public static function ModStatut($idEquip)
    {
        global $bdd;
        
        $stmt1 = $bdd->prepare("UPDATE equipement SET statut='en reparation' WHERE id = :idEquip") ;         
        $stmt1->bindParam(':idEquip',$idEquip);
        $stmt1->execute();
        $stmt1->closeCursor();
        if ($stmt1->rowCount() > 0)
            return true;
        else return false;
         
           
       
    }
    public static function ModStatutF($idEquip)
    {
        global $bdd;
        
        $stmt1 = $bdd->prepare("UPDATE equipement SET statut='en service' WHERE id = :idEquip") ;         
        $stmt1->bindParam(':idEquip',$idEquip);
        $stmt1->execute();
        $stmt1->closeCursor();
        if ($stmt1->rowCount() > 0)
            return true;
        else return false;
         
           
       
    }
    public static function getEquipsA($id)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id,nom,type,statut,id_utilisateur FROM equipement WHERE :id=id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->bindColumn('nom', $nom);
            $stmt->bindColumn('type', $type);
            $stmt->bindColumn('statut', $statut);
            $stmt->bindColumn('id_utilisateur', $idUser);
            $stmt->fetch(PDO::FETCH_BOUND);
            if ($stmt->rowCount() >0)
                {$us=new Equipement($id,$nom,$type,$statut,$idUser);
                return $us;}
            else 
                {return null;}
            $stmt->closeCursor();
           
       
    }
    public static function getEquips($nomEq)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id,nom,type,statut,id_utilisateur FROM equipement WHERE lower(nom) like lower(:nom)");
            $nomres="%$nomEq%";
            $stmt->bindParam(':nom', $nomres);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('nom', $nom);
            $stmt->bindColumn('type', $type);
            $stmt->bindColumn('statut', $statut);
            $stmt->bindColumn('id_utilisateur', $idUser);
            $tabEquip=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabEquip,new Equipement($id,$nom,$type,$statut,$idUser));
            }
           
            $stmt->closeCursor();
            return $tabEquip;
            // lier l'article à ses  fournisseurs
           
       
    }
    public static function getEquipsUser($nomEq,$idUser)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id,nom,type,statut,id_utilisateur FROM equipement WHERE lower(nom) like lower(:nom) and id_utilisateur= :iduser");
            $nomres="%$nomEq%";
            $stmt->bindParam(':nom', $nomres);
            $stmt->bindParam(':iduser', $idUser);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('nom', $nom);
            $stmt->bindColumn('type', $type);
            $stmt->bindColumn('statut', $statut);
            $stmt->bindColumn('id_utilisateur', $idUser);
            $tabEquip=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabEquip,new Equipement($id,$nom,$type,$statut,$idUser));
            }
           
            $stmt->closeCursor();
            return $tabEquip;
            // lier l'article à ses  fournisseurs
           
       
    }
    public static function getEquipsUserAll( $idUserR)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id,nom,type,statut,id_utilisateur FROM equipement WHERE  id_utilisateur=:iduser ");
            
           $stmt->bindParam(':iduser', $idUserR);
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('nom', $nom);
            $stmt->bindColumn('type', $type);
            $stmt->bindColumn('statut', $statut);
            $stmt->bindColumn('id_utilisateur', $idUser);
            $tabEquipAll=array();
            $stmt->execute();
            while ($stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabEquipAll,new Equipement($id,$nom,$type,$statut,$idUser));
            }
           
            $stmt->closeCursor();
            return $tabEquipAll;
         
           
       
    }
    public static function getEquipsUserAllA()
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id,nom,type,statut,id_utilisateur FROM equipement  ");
            
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('nom', $nom);
            $stmt->bindColumn('type', $type);
            $stmt->bindColumn('statut', $statut);
            $stmt->bindColumn('id_utilisateur', $idUser);
            $tabEquipAll=array();
            $stmt->execute();
            while ($stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabEquipAll,new Equipement($id,$nom,$type,$statut,$idUser));
            }
           
            $stmt->closeCursor();
            return $tabEquipAll;
         
           
       
    }
}

?>