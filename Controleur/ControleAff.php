<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <?php  
    include ('../Modele/DemandeRep.php');
require_once '../Modele/DemandeAFF.php';
require_once '../Modele/User.php';
    // Fonction pour rejeter une demande
  function affecterDemandUser()
    {
        session_start();
        $u=$_SESSION["user"];
        //Récupérer les données à partir du formulaire
        if ($u->role == "admin") {
            $idDem = $_POST["id"];
            $nomTech = $_POST["idTech"];
            $u=User::getTechC($nomTech);
            $idTech = $u->id;
            
            $art= new DemandeAFF($idDem,$idTech);
            return ($art->affecterDemand());
            
        } else {
            echo "<script>alert('Vous n\'avez pas le droit d\'affecter cette demande.')</script>";
        
            return false;}
    }
    if (isset($_POST["affecter"])) {
        $aff=affecterDemandUser();
       if($aff ){
        echo "<script>alert('Demande affectée avec succès.')</script>";

        echo "<script>document.location='../Vue/View_DemandAffecte.php'</script>";
    } else {
        echo "<script>alert('Erreur d\'affectation de la demande.')</script>";
    }}
    function RejeterDemandUser()
    {
        session_start();
        $u=$_SESSION["user"];
        //Récupérer les données à partir du formulaire
        if ($u->role == "admin") {
            $id = $_POST["id"];
            $statut = "refusée";
            $dateD = date("Y-m-d");
            $art = new DemandeRep($id, $dateD,  $statut,null, null,null); //,$ptVentes);
 
            return ($art->rejeterDemands());
            
        } else {
            echo "<script>alert('Vous n\'avez pas le droit de rejeter cette demande.')</script>";
        
            return false;}
    }
    function SupprimerDemands()
    {
        session_start();
        $u=$_SESSION["user"];
        //Récupérer les données à partir du formulaire
        if ($u->role == "admin") {
            $idD = $_GET["idD"];
            $idT = $_GET["idT"];
            
            $art = new DemandeAFF($idD,$idT); //,$ptVentes);
 
            return ($art->supprimerDemandAff());
            
        } else {
            echo "<script>alert('Vous n\'avez pas le droit de supprimer cette demande.')</script>";
        
            return false;}
    }
    if (isset($_POST["rejeter"])) {
        $rej=RejeterDemandUser();
       if($rej ){
        echo "<script>alert('Demande rejetée avec succès.')</script>";

        echo "<script>document.location='../Vue/View_DemandAffecte.php'</script>";
    } else {
        echo "<script>alert('Erreur de rejet de la demande.')</script>";
    }}
    if(isset($_GET['idD']) && isset($_GET['idT'])) {
 
        $mod = SupprimerDemands();
        if ($mod){
            echo '<script>alert("Demande Supprimer")</script>';
            echo "<script>document.location='../Vue/View_DemandAffecte.php'</script>";

        }else { echo '<script>alert("Référence non fournie ou Erreur d\'sup!")</script>';
        //Rediriger l'utilisateur vers view_article
        echo "<script>document.location.hid='../Vue/View_DemandAffecte.php'</script>";
        }}
?>
</body>
</html>