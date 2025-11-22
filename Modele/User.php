<?php
include "connexion.php";
class User  
{
    private $id;
    private $nom;
    private $email;
    private $mdp;
    private $role;
    function  __construct($id, $nom, $email, $mdp, $role)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->role = $role;
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
        $ch1 = "<tr><td>$this->id</td><td>$this->nom</td><td>$this->email</td><td>$this->mdp</td><td>$this->role</td>";
        
        return $ch1;
    }
    function ajouterUsers()
    {
        global $bdd;
        try {
            $stmt = $bdd->prepare("INSERT INTO utilisateur(id, nom, email, mot_de_passe,role) VALUES(:id, :nom, :email, :mdp,:role)");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':mdp', $this->mdp);
            $stmt->bindParam(':role', $this->role);
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
    function modifierUsers()
    {
        global $bdd;
        try {
       //Version1 simple: Modifier tous les champs même s'ils sont vides
        $stmt=$bdd->prepare("UPDATE utilisateur SET nom = :nom, email = :email, mot_de_passe =:mdp WHERE id = :id") ;
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':nom',$this->nom);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':mdp',$this->mdp);
      
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
    function modifierADMs()
    {
        global $bdd;
        try {
        $stmt=$bdd->prepare("UPDATE utilisateur SET  nom = :nom, email = :email, mot_de_passe =:mdp, role=:role WHERE id = :id") ;
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':nom',$this->nom);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':mdp',$this->mdp);
        $stmt->bindParam(':role',$this->role);

        $stmt->execute();
        $stmt->closeCursor();
        if ($stmt->rowCount() > 0)
                return true;
            else return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    function supprimerUsers()
    {
        global $bdd;
        $stmt = $bdd->prepare("DELETE FROM utilisateur WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $stmt->closeCursor();

        if ($stmt->rowCount() > 0)
            return true;
        else return false;
    }
    public static function getUser($E,$MDP)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id,nom,role FROM utilisateur WHERE email=:email and mot_de_passe =:mdp");
            $stmt->bindParam(':email', $E);
            $stmt->bindParam(':mdp', $MDP);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('nom', $nom);
            $stmt->bindColumn('role', $role);
            
            $stmt->fetch(PDO::FETCH_BOUND);
            if ($stmt->rowCount() ==1)
                {$us=new User($id,$nom,$E,$MDP,$role);
                return $us;}
            else 
                {return null;}
            $stmt->closeCursor();
            // lier l'article à ses  fournisseurs
           
       
    }
    public static function getUserAllTech()
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id,nom,email,mot_de_passe,role FROM utilisateur where role='technicien' ");
            
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('nom', $nom);
            $stmt->bindColumn('email', $email);
            $stmt->bindColumn('mot_de_passe', $mdp);

            $stmt->bindColumn('role', $role);
            
            $tabUtili=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabUtili,new User($id, $nom,  $email,$mdp, $role));
            }
            $stmt->closeCursor();
            return $tabUtili;
       
    }
    public static function getUserAll()
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id,nom,email,mot_de_passe,role FROM utilisateur ");
            
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('nom', $nom);
            $stmt->bindColumn('email', $email);
            $stmt->bindColumn('mot_de_passe', $mdp);

            $stmt->bindColumn('role', $role);
            
            $tabUtili=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabUtili,new User($id, $nom,  $email,$mdp, $role));
            }
            $stmt->closeCursor();
            return $tabUtili;
       
    }
    public static function getUserAllC($nomUt)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id,nom,email,mot_de_passe,role FROM utilisateur WHERE lower(nom) like lower(:nom) ");
            $nomres="%$nomUt%";
            $stmt->bindParam(':nom', $nomres);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('nom', $nom);
            $stmt->bindColumn('email', $email);
            $stmt->bindColumn('mot_de_passe', $mdp);
            $stmt->bindColumn('role', $role);
            
            $tabUtili=array();
            
            while ($res = $stmt->fetch(PDO::FETCH_BOUND)) {
                array_push($tabUtili,new User($id, $nom,  $email,$mdp, $role));
            }
            $stmt->closeCursor();
            return $tabUtili;
       
    }
    public static function getUserC($id)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id,nom,email,mot_de_passe,role FROM utilisateur WHERE id=:id ");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('nom', $nom);
            $stmt->bindColumn('email', $email);
            $stmt->bindColumn('mot_de_passe', $mdp);
            $stmt->bindColumn('role', $role);
            
            
            
            $stmt->fetch(PDO::FETCH_BOUND);
            if ($stmt->rowCount() ==1)
                {$us=new User($id,$nom,$email,$mdp,$role);
                return $us;}
            else 
                {return null;}
            $stmt->closeCursor();
       
    }
    public static function getTechC($id)
    {
        global $bdd;
        
            $stmt = $bdd->prepare("SELECT id,nom,email,mot_de_passe,role FROM utilisateur WHERE nom=:id ");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('nom', $nom);
            $stmt->bindColumn('email', $email);
            $stmt->bindColumn('mot_de_passe', $mdp);
            $stmt->bindColumn('role', $role);
            
            
            
            $stmt->fetch(PDO::FETCH_BOUND);
            if ($stmt->rowCount() ==1)
                {$us=new User($id,$nom,$email,$mdp,$role);
                return $us;}
            else 
                {return null;}
            $stmt->closeCursor();
       
    }
}

?>