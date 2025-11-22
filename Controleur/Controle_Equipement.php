<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Equipement</title>
</head>
<body>
<?php
include("../Modele/Equipement.php");

function AjouterEquipement()
{
    if (!empty($_POST["id"])) {
        $id = $_POST["id"];
        $nom = $_POST["nom"];
        $type = $_POST["type"];
        $statut = $_POST["statut"];
        $idUser = $_POST["idUser"];
        $equipement = new Equipement($id, $nom, $type, $statut, $idUser);
        return ($equipement->ajouterEquips());
    } else return 0;
}

function modifierEquipement()
{
    if (!empty($_POST["id"])) {
        $id = $_POST["id"];
        $nom = $_POST["nom"];
        $type = $_POST["type"];
        $statut = $_POST["statut"];
        $idUser = $_POST["idUser"];
        $equipement = new Equipement($id, $nom, $type, $statut, $idUser);
        return ($equipement->modifierEquips());
    } else return 0;
}

function supprimerEquipement()
{
    if (!empty($_GET['idSUP'])) {
        $id = $_GET['idSUP'];
        $equipement = new Equipement($id, "", "", "","");
        return ($equipement->supprimerEquips());
    } else return 0;
}

if (isset($_POST["ajouter"])) {
    $ajout = AjouterEquipement();
    if ($ajout)
        echo '<script>alert("Equipement ajouté")</script>';
    else
        echo '<script>alert("Référence non fournie ou Erreur d\'ajout!")</script>';
    echo '<script>document.location="../Vue/View_EquipAdmin.php"</script>';
}

if (isset($_POST["modifier"])) {
    $mod = modifierEquipement();
    if ($mod)
        echo '<script>alert("Equipement modifié")</script>';
    else
        echo '<script>alert("Référence non fournie ou Erreur de modification!")</script>';
    echo '<script>document.location="../Vue/View_EquipAdmin.php"</script>';
}

if (isset($_GET['idSUP'])) {
    $suppr = supprimerEquipement();
    if ($suppr)
        echo '<script>alert("Equipement supprimé")</script>';
    else
        echo '<script>alert("Référence non fournie ou Erreur de suppression!")</script>';
    echo '<script>document.location="../Vue/View_EquipAdmin.php"</script>';
}
?>
</body>
</html>