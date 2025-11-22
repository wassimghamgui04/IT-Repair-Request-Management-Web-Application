<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include("../Modele/DemandeRep.php");
if (isset($_POST["afficher"])) {
    session_start();
    $u=$_SESSION["user"];
    $id = $_POST["id"];
    $idUserR=$u->id;
    $dem=DemandeRep::getDemandUserAFF($id,$idUserR);
    if ($dem!=null) {
        $_SESSION["dem"]=$dem;
    }
    else {
        echo"erreur";
    }
}
    function AjouterDemandUser()
    {
        //On ne peut pas insérer une référence vide dans la BD!
            session_start();
            $userD=$_SESSION["user"];            //Récupérer les données à partir du formulaire
            $id = $_POST["id"];
            $dateD = date("Y-m-d");
            $des = $_POST["des"];
            $idEquip = $_POST["idequip"];
            $statut="en attente";
            $idUser=$userD->id;
            //Construire l'objet article et l'ajouter dans la BD
            $art = new DemandeRep($id, $dateD,  $statut,$des, $idEquip,$idUser); //,$ptVentes);

            return ($art->ajouterDemands());
            echo "<script>document.location='../Vue/View_DemandRepU.php'</script>";
    }
    function ModifierDemandsUser()
    {
        session_start();
        $u=$_SESSION["user"];
        //Récupérer les données à partir du formulaire
        if ($u->role == "admin") {
            $id = $_POST["id"];
            $dateD = $_POST["date"];
            $statut = $_POST["statut"];
            $des = $_POST["des"];
            $idEquip = $_POST["idequip"];
            $idUser = $_POST["idUser"];
            $art = new DemandeRep($id, $dateD,  $statut,$des, $idEquip,$idUser); //,$ptVentes);

            return ($art->modifierDemands());
        echo "<script>document.location='../Vue/View_DemandRepA.php'</script>";
    
        } else {
            $id = $_POST["id"];
        $dateD = date("Y-m-d");
        $des = $_POST["des"];
        $idEquip = $_POST["idequip"];
        $statut="en attente";
        $idUser=$u->id;
        //Construire l'objet article et l'ajouter dans la BD
        $art = new DemandeRep($id, $dateD,  $statut,$des, $idEquip,$idUser); //,$ptVentes);

        return ($art->modifierDemandsU());
        echo "<script>document.location='../Vue/View_DemandRepU.php'</script>";
    
            # code...
        }
        
    }
    function SupprimerDemands()
    {
        
        //Récupérer les données à partir du formulaire
             $id = $_GET['idSUP'];
             $dateD = date("Y-m-d");
             $des = "";
             $idEquip = "";
             $statut="";
             $idUser="";
             //Construire l'objet article et l'ajouter dans la BD
             $art = new DemandeRep($id, $dateD,  $statut,$des, $idEquip,$idUser); //,$ptVentes);

            return ($art->supprimerDemands());
            echo "<script>document.location='../Vue/View_DemandRepU.php'</script>";

        
    }
    if (isset($_POST["ajouter"])) {
        $ajout = AjouterDemandUser();
        if ($ajout)
            echo '<script>alert("Demande ajouté")</script>';
        else  echo '<script>alert("Référence non fournie ou Erreur d\'ajout!")</script>';
        echo "<script>document.location.hid='../Vue/View_DemandRepU.php'</script>";
    }
    if(isset($_POST["modifier"])) {
        $mod = ModifierDemandsUser();
        if ($mod)
            echo '<script>alert("Demande Modifier")</script>';
        else  echo '<script>alert("Référence non fournie ou Erreur d\'ajout!")</script>';
        //Rediriger l'utilisateur vers view_article
        echo "<script>document.location.hid='../Vue/View_DemandRepU.php'</script>";
    }
    if(isset($_GET['idSUP'])) {
 
        $mod = SupprimerDemands();
        if ($mod)
            echo '<script>alert("Demande Supprimer")</script>';
        else  echo '<script>alert("Référence non fournie ou Erreur d\'sup!")</script>';
        //Rediriger l'utilisateur vers view_article
        echo "<script>document.location.hid='../Vue/View_DemandRepU.php'</script>";
    }
?>  
</body>
</html>